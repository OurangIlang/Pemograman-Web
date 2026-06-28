<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetailInvoiceRequest;
use App\Http\Requests\UpdateDetailInvoiceRequest;
use App\Models\Barang;
use App\Models\DetailInvoicePenjualan;
use App\Models\InvoicePenjualan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Detail Invoice Penjualan (sales-invoice line items).
 *
 * Migrated from invoice_penjualan/detail_invoice-{lihat,tambah,ubah,hapus}.php.
 *
 * Composite primary key (no_invoice + id_barang) is handled with explicit
 * two-column WHERE clauses, exactly as for detail_pembelian.
 */
class DetailInvoiceController extends Controller
{
    /**
     * Show one invoice's header plus its line items and grand total
     * (was detail_invoice-lihat.php).
     */
    public function index(string $no_invoice): View
    {
        $invoice = InvoicePenjualan::with(['customer', 'pegawai'])->findOrFail($no_invoice);

        $details = DetailInvoicePenjualan::with('barang')
            ->where('no_invoice', $no_invoice)
            ->get();

        $grandTotal = $details->sum('total_price');

        return view('transaksi.invoice.detail.index', compact('invoice', 'details', 'grandTotal'));
    }

    /**
     * Show the add-item form with a product dropdown
     * (was detail_invoice-tambah.php, GET).
     */
    public function create(string $no_invoice): View
    {
        $invoice = InvoicePenjualan::findOrFail($no_invoice);
        $barang = Barang::all();

        return view('transaksi.invoice.detail.create', compact('invoice', 'barang'));
    }

    /**
     * Persist a new line item (was detail_invoice-tambah.php, POST).
     *
     * sub_total and total_price are recomputed server-side from
     * qty * unit_price.
     */
    public function store(StoreDetailInvoiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $subTotal = (float) $data['qty'] * (float) $data['unit_price'];
        $data['sub_total'] = $subTotal;
        $data['total_price'] = isset($data['total_price']) && $data['total_price'] !== null
            ? (float) $data['total_price']
            : $subTotal;

        DetailInvoicePenjualan::create($data);

        return redirect()
            ->route('invoice.detail.index', ['no_invoice' => $data['no_invoice']])
            ->with('success', 'Item invoice berhasil ditambahkan.');
    }

    /**
     * Show the edit form for one line item (was detail_invoice-ubah.php, GET).
     */
    public function edit(string $no_invoice, string $id_barang): View
    {
        $detail = DetailInvoicePenjualan::where('no_invoice', $no_invoice)
            ->where('id_barang', $id_barang)
            ->firstOrFail();

        $barang = Barang::all();

        return view('transaksi.invoice.detail.edit', compact('detail', 'barang'));
    }

    /**
     * Update one line item (was detail_invoice-ubah.php, POST).
     */
    public function update(UpdateDetailInvoiceRequest $request, string $no_invoice, string $id_barang): RedirectResponse
    {
        $data = $request->validated();

        $qty = (float) $data['qty'];
        $unitPrice = (float) $data['unit_price'];
        $subTotal = $qty * $unitPrice;

        DetailInvoicePenjualan::where('no_invoice', $no_invoice)
            ->where('id_barang', $id_barang)
            ->update([
                'deskripsi' => $data['deskripsi'] ?? null,
                'qty' => $qty,
                'unit_price' => $unitPrice,
                'sub_total' => $subTotal,
                'total_price' => $subTotal,
            ]);

        return redirect()
            ->route('invoice.detail.index', ['no_invoice' => $no_invoice])
            ->with('success', 'Item invoice berhasil diperbarui.');
    }

    /**
     * Delete one line item (was detail_invoice-hapus.php).
     */
    public function destroy(string $no_invoice, string $id_barang): RedirectResponse
    {
        DetailInvoicePenjualan::where('no_invoice', $no_invoice)
            ->where('id_barang', $id_barang)
            ->delete();

        return redirect()
            ->route('invoice.detail.index', ['no_invoice' => $no_invoice])
            ->with('success', 'Item invoice berhasil dihapus.');
    }
}
