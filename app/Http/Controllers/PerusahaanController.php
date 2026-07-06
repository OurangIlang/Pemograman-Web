<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;
use App\Models\Perusahaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Perusahaan (supplier company) master CRUD.
 *
 * Migrated from perusahaan/perusahaan-{lihat,tambah,ubah,hapus}.php.
 *
 * Note: the original perusahaan-tambah.php used a positional INSERT whose
 * column order did not match the form fields (it stored nama_petugas in
 * the nama_penandatangan column, and so on). That was an upstream bug;
 * the original UPDATE used named columns and was correct. This migration
 * uses named columns everywhere (mass assignment), which fixes the bug
 * without altering the intended business behaviour.
 */
class PerusahaanController extends Controller
{
    public function index(): View
    {
        $items = Perusahaan::all();

        return view('master.perusahaan.index', compact('items'));
    }

    public function create(): View
    {
        $nextId = Perusahaan::nextId();

        return view('master.perusahaan.create', compact('nextId'));
    }

    public function store(StorePerusahaanRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status_aktif'] = $request->boolean('status_aktif', true);

        Perusahaan::createWithAutoId($data);

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $item = Perusahaan::findOrFail($id);

        return view('master.perusahaan.edit', compact('item'));
    }

    public function update(UpdatePerusahaanRequest $request, string $id): RedirectResponse
    {
        $item = Perusahaan::findOrFail($id);
        $data = $request->validated();
        $data['status_aktif'] = $request->boolean('status_aktif');
        $item->update($data);

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    /**
     * Delete a supplier company (was perusahaan-hapus.php).
     *
     * Suppliers already referenced by a purchase note must not be
     * removed — enforced first here for a friendly message, and backed
     * by an ON DELETE RESTRICT foreign key at the database level.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = Perusahaan::findOrFail($id);

        if ($item->notaPembelian()->exists()) {
            return redirect()
                ->route('perusahaan.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        try {
            $item->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('perusahaan.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
