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

    /**
     * The product master row. Reads through soft-deleted rows too
     * (withTrashed) so that a "deleted" product never breaks the
     * display of an old invoice that still references it.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang')->withTrashed();
    }

    /**
     * The product's CURRENT unit price, read live from the barang
     * master row rather than the (legacy) `unit_price` value stored on
     * this line item. Falls back to the originally recorded price only
     * if the master row is somehow missing entirely.
     */
    public function getUnitPriceTerkiniAttribute(): float
    {
        return (float) ($this->barang->harga_barang ?? $this->unit_price);
    }

    /**
     * The product's CURRENT name, read live from the master row.
     */
    public function getNamaBarangTerkiniAttribute(): string
    {
        return $this->barang->nama_barang ?? $this->id_barang;
    }

    /**
     * qty x current master price — always up to date with the latest
     * barang price, per the "master data changes must automatically
     * flow through to every transaction" requirement.
     */
    public function getSubTotalTerkiniAttribute(): float
    {
        return (float) $this->qty * $this->unit_price_terkini;
    }
}
