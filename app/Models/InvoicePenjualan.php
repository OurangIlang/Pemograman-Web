<?php

namespace App\Models;

use App\Traits\AutoAudit;
use App\Traits\GeneratesDatedId;
use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Invoice Penjualan (sales invoice) header.
 *
 * Mirrors the original `invoice_penjualan` table. Primary key is the
 * `no_invoice` string, auto-generated in the format INV-YYYYMMDD-001
 * via App\Traits\GeneratesDatedId — never entered manually.
 * `no_faktur` (FK-YYYYMMDD-001) and `no_preorder` (the Purchase Order
 * number, PO-YYYYMMDD-001) are generated the same way at creation time.
 *
 * `created_by` / `updated_by` / `deleted_by` + timestamps were added on
 * top of the original schema to support the "Riwayat Transaksi"
 * (transaction history) log feature and the full audit trail. Both are
 * stamped automatically (see App\Traits\AutoAudit) — never trusted from
 * request input.
 */
class InvoicePenjualan extends Model
{
    use AutoAudit, GeneratesDatedId, HasFactory, LogsActivity, SoftDeletesAudited;

    protected $table = 'invoice_penjualan';

    protected $primaryKey = 'no_invoice';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'no_invoice',
        'no_faktur',
        'no_preorder',
        'id_pegawai',
        'id_customer',
        'tanggal',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    /**
     * The logged-in user (admin or pegawai account) who recorded this
     * transaction — used by the "Riwayat Transaksi" history page.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The logged-in user who last modified this transaction.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * The logged-in user who (soft) deleted this transaction.
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Line items belonging to this invoice.
     */
    public function details()
    {
        return $this->hasMany(DetailInvoicePenjualan::class, 'no_invoice', 'no_invoice');
    }

    /**
     * The products on this invoice (many-to-many via detail table).
     */
    public function barang()
    {
        return $this->belongsToMany(
            Barang::class,
            'detail_invoice_penjualan',
            'no_invoice',
            'id_barang',
            'no_invoice',
            'id_barang'
        )->withPivot(['qty', 'unit_price', 'sub_total', 'total_price', 'deskripsi']);
    }

    /**
     * Sum of line items, computed dynamically from the CURRENT barang
     * price (qty x harga_barang terkini) — never from the price stored
     * at the time the item was recorded. This is what makes a
     * master-data price change instantly reflect on every past and
     * present invoice, report, and history page.
     */
    public function getSubTotalAttribute(): float
    {
        return (float) $this->details->sum(fn (DetailInvoicePenjualan $d) => $d->sub_total_terkini);
    }

    /**
     * Number of distinct line items on this invoice (for "Jumlah Item"
     * on the Riwayat Transaksi page).
     */
    public function getJumlahItemAttribute(): int
    {
        return $this->details->count();
    }
}
