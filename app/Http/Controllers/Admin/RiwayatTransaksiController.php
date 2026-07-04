<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoicePenjualan;
use App\Models\NotaPembelian;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * Admin-only "Riwayat Transaksi" page — a unified, read-only history of
 * every purchase note (nota pembelian) and sales invoice (invoice
 * penjualan): who recorded it, which employee it's for, the total, and
 * the full created/updated/deleted audit trail.
 *
 * Soft-deleted transactions are included (withTrashed) so the history
 * page keeps a complete record even of "deleted" transactions, showing
 * who deleted them and when — nothing is ever truly lost.
 */
class RiwayatTransaksiController extends Controller
{
    public function index(): View
    {
        $nota = NotaPembelian::withTrashed()
            ->with(['pegawai', 'createdBy', 'updatedBy', 'deletedBy', 'details'])
            ->get()
            ->map(function (NotaPembelian $n) {
                return (object) [
                    'nomor' => $n->kode_nota,
                    'jenis' => 'Pembelian',
                    'user' => $n->createdBy->name ?? '-',
                    'pegawai' => $n->pegawai->nama_pegawai ?? '-',
                    'role' => $n->createdBy->role ?? '-',
                    'jumlah_item' => $n->jumlah_item,
                    'tanggal' => $n->tanggal,
                    'total' => $n->grand_total,
                    'status' => $n->trashed() ? 'Dihapus' : 'Selesai',
                    'created_by' => $n->createdBy->name ?? '-',
                    'updated_by' => $n->updatedBy->name ?? '-',
                    'deleted_by' => $n->deletedBy->name ?? '-',
                    'created_at' => $n->created_at,
                    'updated_at' => $n->updated_at,
                ];
            });

        $invoice = InvoicePenjualan::withTrashed()
            ->with(['pegawai', 'createdBy', 'updatedBy', 'deletedBy', 'details'])
            ->get()
            ->map(function (InvoicePenjualan $i) {
                return (object) [
                    'nomor' => $i->no_invoice,
                    'jenis' => 'Penjualan',
                    'user' => $i->createdBy->name ?? '-',
                    'pegawai' => $i->pegawai->nama_pegawai ?? '-',
                    'role' => $i->createdBy->role ?? '-',
                    'jumlah_item' => $i->jumlah_item,
                    'tanggal' => $i->tanggal,
                    'total' => $i->sub_total,
                    'status' => $i->trashed() ? 'Dihapus' : 'Selesai',
                    'created_by' => $i->createdBy->name ?? '-',
                    'updated_by' => $i->updatedBy->name ?? '-',
                    'deleted_by' => $i->deletedBy->name ?? '-',
                    'created_at' => $i->created_at,
                    'updated_at' => $i->updated_at,
                ];
            });

        /** @var Collection $items */
        $items = $nota->concat($invoice)->sortByDesc(function ($row) {
            return $row->tanggal?->timestamp ?? 0;
        })->values();

        return view('logs.transaksi.index', compact('items'));
    }
}
