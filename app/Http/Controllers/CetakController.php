<?php

namespace App\Http\Controllers;

use App\Models\InvoicePenjualan;
use App\Models\NotaPembelian;
use App\Support\Terbilang;
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

        // Original total: sum of qty * harga_satuan over the line items.
        $total = $nota->details->sum(fn ($item) => (float) $item->qty * (float) $item->harga_satuan);

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

        $subtotal = $invoice->details->sum('total_price');
        $ppn = $subtotal * 0.11;
        $grand = $subtotal + $ppn;
        $terbilang = Terbilang::make($grand).' Rupiah';

        return view('transaksi.cetak.invoice', compact('invoice', 'subtotal', 'ppn', 'grand', 'terbilang'));
    }
}
