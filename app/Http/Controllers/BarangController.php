<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Barang (goods) master CRUD.
 *
 * Migrated from barang/barang-{lihat,tambah,ubah,hapus}.php.
 */
class BarangController extends Controller
{
    public function index(): View
    {
        $items = Barang::all();

        return view('master.barang.index', compact('items'));
    }

    public function create(): View
    {
        return view('master.barang.create');
    }

    public function store(StoreBarangRequest $request): RedirectResponse
    {
        Barang::create($request->validated());

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $item = Barang::findOrFail($id);

        return view('master.barang.edit', compact('item'));
    }

    public function update(UpdateBarangRequest $request, string $id): RedirectResponse
    {
        $item = Barang::findOrFail($id);
        $item->update($request->validated());

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Delete a product (was barang-hapus.php).
     *
     * Products already referenced by a sales-invoice line item
     * (detail_invoice_penjualan) must not be removed — the database also
     * enforces this via an ON DELETE RESTRICT foreign key, but we check
     * first so the user gets a friendly message instead of a 500 error.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = Barang::findOrFail($id);

        if ($item->detailInvoice()->exists()) {
            return redirect()
                ->route('barang.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        try {
            $item->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('barang.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
