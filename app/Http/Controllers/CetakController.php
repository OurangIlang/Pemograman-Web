<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\DetailInvoicePenjualan;
use App\Models\DetailPembelian;
use App\Models\InvoicePenjualan;
use App\Models\NotaPembelian;
use App\Support\Terbilang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\View\View;

/**
 * Print / "cetak" pages for purchase notes and sales invoices.
 *
 * Migrated from nota_pembelian/nota_cetak.php and
 * invoice_penjualan/invoice_cetak.php.
 */
class CetakController extends Controller
{
    /**
     * Printable purchase note (was nota_cetak.php).
     */
    public function nota(string $kode_nota): View
    {
        $nota = NotaPembelian::with(['perusahaan', 'pegawai', 'details'])
            ->findOrFail($kode_nota);

        // Dynamic total: qty x CURRENT bahan_baku price, so the printed
        // note always reflects the latest master price.
        $total = $nota->details->sum(fn (DetailPembelian $item) => $item->sub_total_terkini);

        $this->logCetak('nota_pembelian', $kode_nota);

        return view('transaksi.cetak.nota', compact('nota', 'total'));
    }

    /**
     * Printable sales invoice (was invoice_cetak.php), including the
     * 11% VAT line, grand total and the Indonesian "terbilang"
     * (amount in words) string.
     */
    public function invoice(string $no_invoice): View
    {
        $invoice = InvoicePenjualan::with(['customer', 'pegawai', 'details'])
            ->findOrFail($no_invoice);

        // Dynamic subtotal: qty x CURRENT barang price, so the printed
        // invoice always reflects the latest master price.
        $subtotal = $invoice->details->sum(fn (DetailInvoicePenjualan $item) => $item->sub_total_terkini);
        $ppn = $subtotal * 0.11;
        $grand = $subtotal + $ppn;
        $terbilang = Terbilang::make($grand).' Rupiah';

        $this->logCetak('invoice_penjualan', $no_invoice);

        return view('transaksi.cetak.invoice', compact('invoice', 'subtotal', 'ppn', 'grand', 'terbilang'));
    }

    /**
     * Record a "Cetak" (print) entry in the activity log — the print
     * pages don't touch an Eloquent model's create/update/delete
     * lifecycle, so this isn't covered by App\Traits\LogsActivity and
     * is logged explicitly here instead.
     */
    private function logCetak(string $tabel, string $recordId): void
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id' => $user->id ?? null,
            'nama_user' => $user->name ?? 'System',
            'role' => $user->role ?? '-',
            'aktivitas' => 'Cetak',
            'tabel' => $tabel,
            'record_id' => $recordId,
            'data_lama' => null,
            'data_baru' => null,
            'ip_address' => RequestFacade::ip(),
            'user_agent' => RequestFacade::userAgent(),
        ]);
    }
}
