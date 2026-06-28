<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Detail Invoice Penjualan (sales-invoice line item).
 *
 * Mirrors the original `detail_invoice_penjualan` table, which uses a
 * composite primary key (no_invoice + id_barang). Composite keys are
 * handled manually in the controllers.
 */
class DetailInvoicePenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_invoice_penjualan';

    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'no_invoice',
        'id_barang',
        'qty',
        'unit_price',
        'sub_total',
        'total_price',
        'deskripsi',
    ];

    protected $casts = [
        'qty' => 'integer',
        'unit_price' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(InvoicePenjualan::class, 'no_invoice', 'no_invoice');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
