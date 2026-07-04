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

    /**
     * Delete an employee (was pegawai-hapus.php).
     *
     * Employees already tied to a purchase note or sales invoice must
     * not be removed — enforced first here for a friendly message, and
     * backed by an ON DELETE RESTRICT foreign key at the database level.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = Pegawai::findOrFail($id);

        if ($item->notaPembelian()->exists() || $item->invoice()->exists()) {
            return redirect()
                ->route('pegawai.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        try {
            $item->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('pegawai.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}
