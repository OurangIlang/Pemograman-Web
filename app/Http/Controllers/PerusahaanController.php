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
        return view('master.perusahaan.create');
    }

    public function store(StorePerusahaanRequest $request): RedirectResponse
    {
        Perusahaan::create($request->validated());

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
        $item->update($request->validated());

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Perusahaan::where('id_perusahaan', $id)->delete();

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
