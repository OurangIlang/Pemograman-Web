<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Pegawai (employee) master CRUD.
 *
 * Migrated from pegawai/pegawai-{lihat,tambah,ubah,hapus}.php.
 */
class PegawaiController extends Controller
{
    public function index(): View
    {
        $items = Pegawai::all();

        return view('master.pegawai.index', compact('items'));
    }

    public function create(): View
    {
        return view('master.pegawai.create');
    }

    public function store(StorePegawaiRequest $request): RedirectResponse
    {
        Pegawai::create($request->validated());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $item = Pegawai::findOrFail($id);

        return view('master.pegawai.edit', compact('item'));
    }

    public function update(UpdatePegawaiRequest $request, string $id): RedirectResponse
    {
        $item = Pegawai::findOrFail($id);
        $item->update($request->validated());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Pegawai::where('id_pegawai', $id)->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}
