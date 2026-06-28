# PT Ken Mandiri Teknik — Sistem Inventory & Penjualan (Laravel 12)

Aplikasi manajemen pembelian (nota pembelian) dan penjualan (invoice) untuk
PT Ken Mandiri Teknik. Ini adalah hasil migrasi **1:1** dari aplikasi PHP-native
asli ke **Laravel 12** (PHP 8.3+, MySQL/MariaDB) dengan pola MVC, Eloquent ORM,
Blade, Middleware, Form Request Validation, Migration, Seeder, Resource
Controller, foreign-key constraints, proteksi CSRF, dan autentikasi.

Tampilan (UI/UX), alur kerja, nama tabel/kolom, dan relasi dipertahankan persis
seperti aplikasi asli.

---

## Persyaratan

- PHP >= 8.3
- Composer 2
- MySQL >= 8 atau MariaDB >= 10.4
- Ekstensi PHP standar Laravel (OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo)

---

## Cara Menjalankan

```bash
# 1. Install dependency
composer install

# 2. Siapkan environment
cp .env.example .env
php artisan key:generate

# 3. Sesuaikan koneksi database di .env
#    DB_DATABASE=pt_ken_mandiri_teknik
#    DB_USERNAME=root
#    DB_PASSWORD=
#    (buat database kosong bernama pt_ken_mandiri_teknik terlebih dulu)

# 4. Jalankan migrasi + seeder (membuat tabel & data contoh)
php artisan migrate --seed

# 5. Jalankan server
php artisan serve
```

Buka http://127.0.0.1:8000

> Jika ingin meng-compile aset front-end (opsional, aplikasi memakai CDN untuk
> Bootstrap/DataTables sehingga tidak wajib): `npm install && npm run build`.

---

## Akun Login

Aplikasi asli tidak memiliki tabel `users` — ia memvalidasi login terhadap
tabel `pegawai` berdasarkan nama, dengan akun super-admin hard-coded. Pada
migrasi ini autentikasi memakai sistem bawaan Laravel, dan akun berikut dibuat
oleh seeder:

| Username        | Password      | Role     |
| --------------- | ------------- | -------- |
| `admin`         | `admin123`    | admin    |
| (nama pegawai)  | `password123` | pegawai  |

Contoh: jika ada pegawai bernama "Nama Pegawai", maka username-nya adalah
`Nama Pegawai` dengan password `password123`.

> **Ganti password ini setelah login pertama.**

---

## Struktur Data

8 tabel inti dipertahankan dari skema asli (semua memakai primary key bertipe
string, tanpa auto-increment, tanpa timestamps):

- `bahan_baku`, `barang`, `customer`, `pegawai`, `perusahaan` (master)
- `nota_pembelian` → `detail_pembelian` (composite PK: `kode_nota` + `id_bahan_baku`)
- `invoice_penjualan` → `detail_invoice_penjualan` (composite PK: `no_invoice` + `id_barang`)

Foreign key dengan `ON UPDATE CASCADE` (dan `ON DELETE CASCADE` pada tabel
detail) dipertahankan sesuai dump SQL asli. Dump asli juga disertakan di
`database/pt_ken_mandiri_teknik.sql` sebagai referensi.

---

## Catatan Migrasi (perbaikan bug)

Selama migrasi ditemukan dan diperbaiki bug berikut **tanpa mengubah logika
bisnis**:

1. **`perusahaan-tambah.php` (INSERT posisional yang salah kolom).**
   Form tambah perusahaan pada aplikasi asli memakai `INSERT` berbasis posisi
   yang urutannya tidak cocok dengan field form (mis. `nama_petugas` tersimpan
   ke kolom `nama_penandatangan`). Jalur UPDATE-nya sudah benar (memakai nama
   kolom). Pada Laravel, semua operasi memakai mass-assignment berbasis nama
   kolom sehingga data tersimpan ke kolom yang tepat.

2. **Login tanpa tabel kredensial.**
   Login asli bergantung pada pencocokan nama pegawai + fallback admin
   hard-coded (tabel `pegawai` tidak punya kolom password). Ditambahkan tabel
   `users` + `UserSeeder` untuk menyediakan kredensial yang aman lewat sistem
   Auth Laravel. Lihat tabel akun di atas.

3. **Perhitungan total di sisi server.**
   Sub-total dan total pada baris detail kini dihitung ulang di server
   (`qty × harga`) untuk menjaga integritas, selain tetap menghitung otomatis
   di sisi klien (JavaScript) seperti aslinya.

Selain itu, blok sidebar/topbar/CSS yang sebelumnya diduplikasi di setiap
halaman master kini direfaktor menjadi satu layout Blade bersama
(`resources/views/layouts/app.blade.php`) sesuai praktik terbaik Laravel —
tanpa mengubah tampilan.

---

## Peta Fitur → Kode

| Modul                | Controller                       | Views                                  |
| -------------------- | -------------------------------- | -------------------------------------- |
| Dashboard            | `DashboardController`            | `dashboard/index`                      |
| Bahan Baku           | `BahanBakuController`           | `master/bahan_baku/*`                  |
| Barang               | `BarangController`              | `master/barang/*`                      |
| Customer             | `CustomerController`            | `master/customer/*`                    |
| Pegawai              | `PegawaiController`             | `master/pegawai/*`                     |
| Perusahaan           | `PerusahaanController`         | `master/perusahaan/*`                  |
| Nota Pembelian       | `NotaPembelianController`      | `transaksi/nota/*`                     |
| Detail Nota          | `DetailPembelianController`    | `transaksi/nota/detail/*`              |
| Invoice Penjualan    | `InvoicePenjualanController`   | `transaksi/invoice/*`                  |
| Detail Invoice       | `DetailInvoiceController`      | `transaksi/invoice/detail/*`           |
| Cetak Nota & Invoice | `CetakController`              | `transaksi/cetak/{nota,invoice}`       |
| Login                | `Auth/LoginController`         | `auth/login`                           |

Helper angka-ke-terbilang (untuk cetak invoice) ada di `app/Support/Terbilang.php`.
