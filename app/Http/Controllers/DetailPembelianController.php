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

        $grandTotal = $details->sum('total_harga');

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
     * Sub-total and total are recomputed server-side from qty * unit
     * price to guarantee integrity regardless of the posted values.
     */
    public function store(StoreDetailPembelianRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $subTotal = (float) $data['qty'] * (float) $data['harga_satuan'];
        $data['sub_total'] = $subTotal;
        // The original form lets the user override total (for discount /
        // tax). Fall back to the computed sub-total when not provided.
        $data['total_harga'] = isset($data['total_harga']) && $data['total_harga'] !== null
            ? (float) $data['total_harga']
            : $subTotal;

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
     * Mirrors the original: sub_total and total_harga are derived from
     * qty * harga_satuan.
     */
    public function update(UpdateDetailPembelianRequest $request, string $kode_nota, string $id_bahan_baku): RedirectResponse
    {
        $data = $request->validated();

        $qty = (float) $data['qty'];
        $hargaSatuan = (float) $data['harga_satuan'];
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
