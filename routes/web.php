<?php

use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\RiwayatLoginController;
use App\Http\Controllers\Admin\RiwayatTransaksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailInvoiceController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\InvoicePenjualanController;
use App\Http\Controllers\NotaPembelianController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerusahaanController;
use Illuminate\Support\Facades\Route;

// Public
Route::view('/', 'welcome')->name('home');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated — any role
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi: accessible by both roles
    Route::resource('nota', NotaPembelianController::class)
        ->parameters(['nota' => 'kode_nota'])
        ->except(['show']);

    Route::prefix('nota/{kode_nota}/detail')->name('nota.detail.')->group(function () {
        Route::get('/', [DetailPembelianController::class, 'index'])->name('index');
        Route::get('/create', [DetailPembelianController::class, 'create'])->name('create');
        Route::get('/{id_bahan_baku}/edit', [DetailPembelianController::class, 'edit'])->name('edit');
        Route::put('/{id_bahan_baku}', [DetailPembelianController::class, 'update'])->name('update');
        Route::delete('/{id_bahan_baku}', [DetailPembelianController::class, 'destroy'])->name('destroy');
    });
    Route::post('nota-detail', [DetailPembelianController::class, 'store'])->name('nota.detail.store');
    Route::get('nota/{kode_nota}/cetak', [CetakController::class, 'nota'])->name('nota.cetak');

    Route::resource('invoice', InvoicePenjualanController::class)
        ->parameters(['invoice' => 'no_invoice'])
        ->except(['show']);

    Route::prefix('invoice/{no_invoice}/detail')->name('invoice.detail.')->group(function () {
        Route::get('/', [DetailInvoiceController::class, 'index'])->name('index');
        Route::get('/create', [DetailInvoiceController::class, 'create'])->name('create');
        Route::get('/{id_barang}/edit', [DetailInvoiceController::class, 'edit'])->name('edit');
        Route::put('/{id_barang}', [DetailInvoiceController::class, 'update'])->name('update');
        Route::delete('/{id_barang}', [DetailInvoiceController::class, 'destroy'])->name('destroy');
    });
    Route::post('invoice-detail', [DetailInvoiceController::class, 'store'])->name('invoice.detail.store');
    Route::get('invoice/{no_invoice}/cetak', [CetakController::class, 'invoice'])->name('invoice.cetak');

    // Master data — ADMIN ONLY
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('bahan_baku', BahanBakuController::class)
            ->parameters(['bahan_baku' => 'id_bahan_baku'])
            ->except(['show']);

        Route::resource('barang', BarangController::class)
            ->parameters(['barang' => 'id_barang'])
            ->except(['show']);

        Route::resource('customer', CustomerController::class)
            ->parameters(['customer' => 'id_customer'])
            ->except(['show']);

        Route::resource('pegawai', PegawaiController::class)
            ->parameters(['pegawai' => 'id_pegawai'])
            ->except(['show']);

        Route::resource('perusahaan', PerusahaanController::class)
            ->parameters(['perusahaan' => 'id_perusahaan'])
            ->except(['show']);

        // Log Aktivitas, Riwayat Login & Riwayat Transaksi — admin only.
        Route::get('log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
        Route::get('riwayat-login', [RiwayatLoginController::class, 'index'])->name('riwayat-login.index');
        Route::get('riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])->name('riwayat-transaksi.index');
    });
});
