<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoicePenjualanRequest;
use App\Http\Requests\UpdateInvoicePenjualanRequest;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\DetailInvoicePenjualan;
use App\Models\InvoicePenjualan;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Invoice Penjualan (sales invoice) header CRUD.
 *
 * Migrated from invoice_penjualan/invoice_penjualan-{lihat,tambah,ubah,hapus}.php.
 */
class InvoicePenjualanController extends Controller
{
    /**
     * List sales invoices (was invoice_penjualan-lihat.php).
     */
    public function index(): View
    {
        $items = InvoicePenjualan::with(['customer', 'pegawai', 'details.barang'])->get();

        return view('transaksi.invoice.index', compact('items'));
    }

    /**
     * Show the multi-step create form: Step 1 (header — no. invoice,
     * no. faktur, no. PO, customer, pegawai), Step 2 (product line
     * items, picked live from the database), Step 3 (review + save).
     * All three numbers are generated up front purely for display — the
     * values actually persisted are always recomputed server-side at
     * save time (see store()), so they can never go stale or collide
     * even if the form sits open for a while.
     */
    public function create(): View
    {
        $nextNoInvoice = InvoicePenjualan::nextDatedId('no_invoice', 'INV');
        $nextNoFaktur = InvoicePenjualan::nextDatedId('no_faktur', 'FK');
        $nextNoPreorder = InvoicePenjualan::nextDatedId('no_preorder', 'PO');
        $customer = Customer::all();
        $pegawai = Pegawai::all();
        $barang = Barang::all();

        return view('transaksi.invoice.create', compact(
            'nextNoInvoice', 'nextNoFaktur', 'nextNoPreorder', 'customer', 'pegawai', 'barang'
        ));
    }

    /**
     * Persist a new sales invoice together with all of its line items
     * in one atomic step (was invoice_penjualan-tambah.php, POST — now
     * fed by the multi-step wizard).
     *
     * no_invoice, no_faktur and no_preorder are always server-generated
     * (INV-/FK-/PO-YYYYMMDD-001, never taken from client input) and
     * each line item's unit price is always re-read from the current
     * barang master price rather than trusted from the request.
     */
    public function store(StoreInvoicePenjualanRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $items = $data['items'];
        unset($data['items']);

        $noInvoice = DB::transaction(function () use ($data, $items, $request) {
            $today = now()->format('Ymd');

            // Lock today's no_faktur / no_preorder rows too, alongside
            // the no_invoice lock inside createWithDatedId(), so two
            // concurrent submissions can never be handed the same
            // faktur or PO number for the same day.
            InvoicePenjualan::query()
                ->where('no_faktur', 'like', "FK-{$today}-%")
                ->orWhere('no_preorder', 'like', "PO-{$today}-%")
                ->lockForUpdate()
                ->get(['no_invoice']);

            $data['no_faktur'] = InvoicePenjualan::nextDatedId('no_faktur', 'FK');
            $data['no_preorder'] = InvoicePenjualan::nextDatedId('no_preorder', 'PO');
            $data['created_by'] = $request->user()?->id;

            $invoice = InvoicePenjualan::createWithDatedId('no_invoice', 'INV', $data);

            foreach ($items as $item) {
                $unitPrice = (float) Barang::findOrFail($item['id_barang'])->harga_barang;
                $qty = (float) $item['qty'];
                $subTotal = $qty * $unitPrice;

                DetailInvoicePenjualan::create([
                    'no_invoice' => $invoice->no_invoice,
                    'id_barang' => $item['id_barang'],
                    'deskripsi' => $item['deskripsi'] ?? null,
                    'qty' => $qty,
                    'unit_price' => $unitPrice,
                    'sub_total' => $subTotal,
                    'total_price' => $subTotal,
                ]);
            }

            return $invoice->no_invoice;
        });

        return redirect()
            ->route('invoice.detail.index', ['no_invoice' => $noInvoice])
            ->with('success', 'Invoice penjualan berhasil ditambahkan.');
    }

    /**
     * Show edit form (was invoice_penjualan-ubah.php, GET).
     */
    public function edit(string $no_invoice): View
    {
        $item = InvoicePenjualan::findOrFail($no_invoice);
        $customer = Customer::all();
        $pegawai = Pegawai::all();

        return view('transaksi.invoice.edit', compact('item', 'customer', 'pegawai'));
    }

    /**
     * Update an invoice (was invoice_penjualan-ubah.php, POST).
     */
    public function update(UpdateInvoicePenjualanRequest $request, string $no_invoice): RedirectResponse
    {
        $item = InvoicePenjualan::findOrFail($no_invoice);
        $item->update($request->validated());

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice penjualan berhasil diperbarui.');
    }

    /**
     * Delete an invoice (was invoice_penjualan-hapus.php).
     *
     * Loaded as a model instance (not a query-builder mass delete) so
     * that Eloquent's model events fire: this is what stamps
     * `deleted_by` (App\Traits\SoftDeletesAudited) and records the
     * "Hapus" activity log entry (App\Traits\LogsActivity). The invoice
     * is soft-deleted, never actually removed from the database.
     */
    public function destroy(string $no_invoice): RedirectResponse
    {
        InvoicePenjualan::findOrFail($no_invoice)->delete();

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice penjualan berhasil dihapus.');
    }
}
