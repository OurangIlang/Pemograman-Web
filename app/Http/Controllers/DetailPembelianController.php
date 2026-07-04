<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetailPembelianRequest;
use App\Http\Requests\UpdateDetailPembelianRequest;
use App\Models\BahanBaku;
use App\Models\DetailPembelian;
use App\Models\NotaPembelian;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Detail Pembelian (purchase-note line items).
 *
 * Migrated from nota_pembelian/detail_nota-{lihat,tambah,ubah,hapus}.php.
 *
 * detail_pembelian has a composite primary key (kode_nota +
 * id_bahan_baku). Eloquent has no native composite-key support, so each
 * row is addressed with an explicit two-column WHERE clause.
 */
class DetailPembelianController extends Controller
{
    /**
     * Show one note's header plus its line items and grand total
     * (was detail_nota-lihat.php).
     */
    public function index(string $kode_nota): View
    {
        $nota = NotaPembelian::with(['perusahaan', 'pegawai'])->findOrFail($kode_nota);

        $details = DetailPembelian::with('bahanBaku')
            ->where('kode_nota', $kode_nota)
            ->get();

        // Dynamic grand total: qty x CURRENT bahan_baku price for every
        // line item, so a master price change is reflected immediately.
        $grandTotal = $details->sum(fn (DetailPembelian $d) => $d->sub_total_terkini);

        return view('transaksi.nota.detail.index', compact('nota', 'details', 'grandTotal'));
    }

    /**
     * Show the add-item form with a raw-material dropdown
     * (was detail_nota-tambah.php, GET). The dropdown carries each
     * material's price in a data-attribute for client-side auto-fill.
     */
    public function create(string $kode_nota): View
    {
        $nota = NotaPembelian::findOrFail($kode_nota);
        $bahanBaku = BahanBaku::all();

        return view('transaksi.nota.detail.create', compact('nota', 'bahanBaku'));
    }

    /**
     * Persist a new line item (was detail_nota-tambah.php, POST).
     *
     * The unit price is ALWAYS taken from the current bahan_baku master
     * price — never from client input — so a stale or tampered price
     * can never be recorded. sub_total/total_harga are then derived
     * from qty x that price. These columns remain on the table only as
     * a point-in-time snapshot; every read in the app (detail list,
     * cetak, riwayat transaksi, grand totals) uses the live
     * `sub_total_terkini` accessor instead, which always reflects the
     * bahan_baku's current price even if it changes later.
     */
    public function store(StoreDetailPembelianRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $hargaSatuan = (float) BahanBaku::findOrFail($data['id_bahan_baku'])->harga_bahan_baku;
        $subTotal = (float) $data['qty'] * $hargaSatuan;

        $data['harga_satuan'] = $hargaSatuan;
        $data['sub_total'] = $subTotal;
        $data['total_harga'] = $subTotal;

        DetailPembelian::create($data);

        return redirect()
            ->route('nota.detail.index', ['kode_nota' => $data['kode_nota']])
            ->with('success', 'Item nota berhasil ditambahkan.');
    }

    /**
     * Show the edit form for one line item (was detail_nota-ubah.php, GET).
     */
    public function edit(string $kode_nota, string $id_bahan_baku): View
    {
        $detail = DetailPembelian::where('kode_nota', $kode_nota)
            ->where('id_bahan_baku', $id_bahan_baku)
            ->firstOrFail();

        $bahanBaku = BahanBaku::all();

        return view('transaksi.nota.detail.edit', compact('detail', 'bahanBaku'));
    }

    /**
     * Update one line item (was detail_nota-ubah.php, POST).
     *
     * The unit price is always re-read from the current bahan_baku
     * master price (never trusted from client input); sub_total and
     * total_harga are derived from qty * that price.
     */
    public function update(UpdateDetailPembelianRequest $request, string $kode_nota, string $id_bahan_baku): RedirectResponse
    {
        $data = $request->validated();

        $qty = (float) $data['qty'];
        $hargaSatuan = (float) BahanBaku::findOrFail($id_bahan_baku)->harga_bahan_baku;
        $subTotal = $qty * $hargaSatuan;

        DetailPembelian::where('kode_nota', $kode_nota)
            ->where('id_bahan_baku', $id_bahan_baku)
            ->update([
                'keterangan' => $data['keterangan'] ?? null,
                'qty' => $qty,
                'harga_satuan' => $hargaSatuan,
                'sub_total' => $subTotal,
                'total_harga' => $subTotal,
            ]);

        return redirect()
            ->route('nota.detail.index', ['kode_nota' => $kode_nota])
            ->with('success', 'Item nota berhasil diperbarui.');
    }

    /**
     * Delete one line item (was detail_nota-hapus.php).
     */
    public function destroy(string $kode_nota, string $id_bahan_baku): RedirectResponse
    {
        DetailPembelian::where('kode_nota', $kode_nota)
            ->where('id_bahan_baku', $id_bahan_baku)
            ->delete();

        return redirect()
            ->route('nota.detail.index', ['kode_nota' => $kode_nota])
            ->with('success', 'Item nota berhasil dihapus.');
    }
}
