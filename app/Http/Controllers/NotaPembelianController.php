<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaPembelianRequest;
use App\Http\Requests\UpdateNotaPembelianRequest;
use App\Models\NotaPembelian;
use App\Models\Pegawai;
use App\Models\Perusahaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Nota Pembelian (purchase note) header CRUD.
 *
 * Migrated from nota_pembelian/nota_pembelian-{lihat,tambah,ubah,hapus}.php.
 * The original list page LEFT JOINed perusahaan, pegawai and (the first)
 * bahan_baku through detail_pembelian; here that is expressed with
 * eager-loaded Eloquent relationships.
 */
class NotaPembelianController extends Controller
{
    /**
     * List purchase notes (was nota_pembelian-lihat.php).
     */
    public function index(): View
    {
        $items = NotaPembelian::with(['perusahaan', 'pegawai', 'details.bahanBaku'])->get();

        return view('transaksi.nota.index', compact('items'));
    }

    /**
     * Show create form with supplier + employee dropdowns
     * (was nota_pembelian-tambah.php, GET).
     */
    public function create(): View
    {
        $perusahaan = Perusahaan::all();
        $pegawai = Pegawai::all();

        return view('transaksi.nota.create', compact('perusahaan', 'pegawai'));
    }

    /**
     * Persist a new purchase note (was nota_pembelian-tambah.php, POST).
     */
    public function store(StoreNotaPembelianRequest $request): RedirectResponse
    {
        NotaPembelian::create($request->validated());

        return redirect()
            ->route('nota.index')
            ->with('success', 'Nota pembelian berhasil ditambahkan.');
    }

    /**
     * Show edit form (was nota_pembelian-ubah.php, GET).
     */
    public function edit(string $kode_nota): View
    {
        $item = NotaPembelian::findOrFail($kode_nota);
        $perusahaan = Perusahaan::all();
        $pegawai = Pegawai::all();

        return view('transaksi.nota.edit', compact('item', 'perusahaan', 'pegawai'));
    }

    /**
     * Update a purchase note (was nota_pembelian-ubah.php, POST).
     */
    public function update(UpdateNotaPembelianRequest $request, string $kode_nota): RedirectResponse
    {
        $item = NotaPembelian::findOrFail($kode_nota);
        $item->update($request->validated());

        return redirect()
            ->route('nota.index')
            ->with('success', 'Nota pembelian berhasil diperbarui.');
    }

    /**
     * Delete a purchase note (was nota_pembelian-hapus.php).
     *
     * The FK constraint on detail_pembelian uses ON DELETE CASCADE, so
     * line items are removed automatically by the database.
     */
    public function destroy(string $kode_nota): RedirectResponse
    {
        NotaPembelian::where('kode_nota', $kode_nota)->delete();

        return redirect()
            ->route('nota.index')
            ->with('success', 'Nota pembelian berhasil dihapus.');
    }
}
