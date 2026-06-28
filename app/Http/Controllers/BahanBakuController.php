<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBahanBakuRequest;
use App\Http\Requests\UpdateBahanBakuRequest;
use App\Models\BahanBaku;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Bahan Baku (raw material) master CRUD.
 *
 * Migrated from bahan_baku/bahan_baku-{lihat,tambah,ubah,hapus}.php.
 */
class BahanBakuController extends Controller
{
    /**
     * List all raw materials (was bahan_baku-lihat.php).
     */
    public function index(): View
    {
        $items = BahanBaku::all();

        return view('master.bahan_baku.index', compact('items'));
    }

    /**
     * Show the create form (was bahan_baku-tambah.php, GET).
     */
    public function create(): View
    {
        return view('master.bahan_baku.create');
    }

    /**
     * Persist a new raw material (was bahan_baku-tambah.php, POST).
     */
    public function store(StoreBahanBakuRequest $request): RedirectResponse
    {
        BahanBaku::create($request->validated());

        return redirect()
            ->route('bahan_baku.index')
            ->with('success', 'Data bahan baku berhasil ditambahkan.');
    }

    /**
     * Show the edit form (was bahan_baku-ubah.php, GET).
     */
    public function edit(string $id): View
    {
        $item = BahanBaku::findOrFail($id);

        return view('master.bahan_baku.edit', compact('item'));
    }

    /**
     * Update a raw material (was bahan_baku-ubah.php, POST).
     */
    public function update(UpdateBahanBakuRequest $request, string $id): RedirectResponse
    {
        $item = BahanBaku::findOrFail($id);
        $item->update($request->validated());

        return redirect()
            ->route('bahan_baku.index')
            ->with('success', 'Data bahan baku berhasil diperbarui.');
    }

    /**
     * Delete a raw material (was bahan_baku-hapus.php).
     */
    public function destroy(string $id): RedirectResponse
    {
        BahanBaku::where('id_bahan_baku', $id)->delete();

        return redirect()
            ->route('bahan_baku.index')
            ->with('success', 'Data bahan baku berhasil dihapus.');
    }
}
