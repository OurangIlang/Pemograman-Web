<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\InvoicePenjualan;
use App\Models\NotaPembelian;
use App\Models\Pegawai;
use App\Models\Perusahaan;
use Illuminate\View\View;

/**
 * Dashboard / home page (was home.php).
 *
 * Shows entity counts and the most recent purchase notes and sales
 * invoices, mirroring the original dashboard queries via Eloquent.
 */
class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'customer' => Customer::count(),
            'perusahaan' => Perusahaan::count(),
            'barang' => Barang::count(),
            'bahan_baku' => BahanBaku::count(),
            'pegawai' => Pegawai::count(),
            'nota' => NotaPembelian::count(),
            'invoice' => InvoicePenjualan::count(),
        ];

        // Recent purchase notes (with related supplier / employee /
        // first raw material), newest first — limited to 6 like the
        // original query.
        $recentNota = NotaPembelian::with(['perusahaan', 'pegawai', 'details.bahanBaku'])
            ->orderByDesc('tanggal')
            ->limit(6)
            ->get();

        // Recent sales invoices (with customer + first product).
        $recentInvoice = InvoicePenjualan::with(['customer', 'details.barang'])
            ->orderByDesc('tanggal')
            ->limit(6)
            ->get();

        return view('dashboard.index', compact('stats', 'recentNota', 'recentInvoice'));
    }
}
