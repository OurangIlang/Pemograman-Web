<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoicePenjualanRequest;
use App\Http\Requests\UpdateInvoicePenjualanRequest;
use App\Models\Customer;
use App\Models\InvoicePenjualan;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
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
     * Show create form with customer + employee dropdowns
     * (was invoice_penjualan-tambah.php, GET).
     */
    public function create(): View
    {
        $customer = Customer::all();
        $pegawai = Pegawai::all();

        return view('transaksi.invoice.create', compact('customer', 'pegawai'));
    }

    /**
     * Persist a new invoice (was invoice_penjualan-tambah.php, POST).
     */
    public function store(StoreInvoicePenjualanRequest $request): RedirectResponse
    {
        InvoicePenjualan::create($request->validated());

        return redirect()
            ->route('invoice.index')
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
     * detail_invoice_penjualan has ON DELETE CASCADE, so its rows are
     * removed automatically.
     */
    public function destroy(string $no_invoice): RedirectResponse
    {
        InvoicePenjualan::where('no_invoice', $no_invoice)->delete();

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice penjualan berhasil dihapus.');
    }
}
