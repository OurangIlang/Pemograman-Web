<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaPembelianRequest;
use App\Http\Requests\UpdateNotaPembelianRequest;
use App\Models\BahanBaku;
use App\Models\DetailPembelian;
use App\Models\NotaPembelian;
use App\Models\Pegawai;
use App\Models\Perusahaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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
     * Show the multi-step create form: Step 1 (header), Step 2 (raw
     * material line items, picked live from the database), Step 3
     * (review + save). The Kode Nota is generated up front purely for
     * display — the value actually persisted is always recomputed
     * server-side at save time (see store()), so it can never go stale
     * or collide even if the form sits open for a while.
     */
    public function create(): View
    {
        $nextId = NotaPembelian::nextDatedId('kode_nota', 'NP');
        $perusahaan = Perusahaan::all();
        $pegawai = Pegawai::all();
        $bahanBaku = BahanBaku::all();

        return view('transaksi.nota.create', compact('nextId', 'perusahaan', 'pegawai', 'bahanBaku'));
    }

    /**
     * Persist a new purchase note together with all of its line items
     * in one atomic step (was nota_pembelian-tambah.php, POST — now
     * fed by the multi-step wizard).
     *
     * The kode_nota is always server-generated (NP-YYYYMMDD-001,
     * never taken from client input) and each line item's unit price
     * is always re-read from the current bahan_baku master price
     * rather than trusted from the request.
     */
    public function store(StoreNotaPembelianRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $items = $data['items'];
        unset($data['items']);

        $kodeNota = DB::transaction(function () use ($data, $items, $request) {
            $nota = NotaPembelian::createWithDatedId('kode_nota', 'NP', $data + [
                'created_by' => $request->user()?->id,
            ]);

            foreach ($items as $item) {
                $hargaSatuan = (float) BahanBaku::findOrFail($item['id_bahan_baku'])->harga_bahan_baku;
                $qty = (float) $item['qty'];
                $subTotal = $qty * $hargaSatuan;

                DetailPembelian::create([
                    'kode_nota' => $nota->kode_nota,
                    'id_bahan_baku' => $item['id_bahan_baku'],
                    'keterangan' => $item['keterangan'] ?? null,
                    'qty' => $qty,
                    'harga_satuan' => $hargaSatuan,
                    'sub_total' => $subTotal,
                    'total_harga' => $subTotal,
                ]);
            }

            return $nota->kode_nota;
        });

        return redirect()
            ->route('nota.detail.index', ['kode_nota' => $kodeNota])
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
     * Loaded as a model instance (not a query-builder mass delete) so
     * that Eloquent's model events fire: this is what stamps
     * `deleted_by` (App\Traits\SoftDeletesAudited) and records the
     * "Hapus" activity log entry (App\Traits\LogsActivity). The note is
     * soft-deleted, never actually removed from the database.
     */
    public function destroy(string $kode_nota): RedirectResponse
    {
        NotaPembelian::findOrFail($kode_nota)->delete();

        return redirect()
            ->route('nota.index')
            ->with('success', 'Nota pembelian berhasil dihapus.');
    }
}
