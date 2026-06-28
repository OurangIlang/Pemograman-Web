<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Invoice Penjualan (sales invoice) header.
 *
 * Mirrors the original `invoice_penjualan` table. Primary key is the
 * human-entered `no_invoice` string.
 */
class InvoicePenjualan extends Model
{
    use HasFactory;

    protected $table = 'invoice_penjualan';

    protected $primaryKey = 'no_invoice';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'no_invoice',
        'no_faktur',
        'no_preorder',
        'id_pegawai',
        'id_customer',
        'tanggal',
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
     * Sum of line-item total_price (the invoice sub total).
     */
    public function getSubTotalAttribute(): float
    {
        return (float) $this->details->sum('total_price');
    }
}
