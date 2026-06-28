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

    public function destroy(string $id): RedirectResponse
    {
        Barang::where('id_barang', $id)->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
