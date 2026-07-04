<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Detail Pembelian (purchase-note line item).
 *
 * Mirrors the original `detail_pembelian` table. This table uses a
 * composite primary key (kode_nota + id_bahan_baku); Eloquent does not
 * support composite keys natively, so single-key assumptions are
 * disabled and lookups are always performed with both columns.
 */
class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian';

    /**
     * Composite key — handled manually in the controllers.
     */
    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'kode_nota',
        'id_bahan_baku',
        'qty',
        'harga_satuan',
        'sub_total',
        'total_harga',
        'keterangan',
    ];

    protected $casts = [
        'qty' => 'integer',
        'harga_satuan' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    public function notaPembelian()
    {
        return $this->belongsTo(NotaPembelian::class, 'kode_nota', 'kode_nota');
    }

    /**
     * The raw material master row. Reads through soft-deleted rows too
     * (withTrashed) so that a "deleted" raw material never breaks the
     * display of an old transaction that still references it.
     */
    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku', 'id_bahan_baku')->withTrashed();
    }

    /**
     * The raw material's CURRENT unit price, read live from the
     * bahan_baku master row rather than the (legacy) `harga_satuan`
     * value stored on this line item. If the master row is ever
     * missing entirely, fall back to the originally recorded price so
     * old data still displays something sensible.
     */
    public function getHargaSatuanTerkiniAttribute(): float
    {
        return (float) ($this->bahanBaku->harga_bahan_baku ?? $this->harga_satuan);
    }

    /**
     * The raw material's CURRENT name, read live from the master row.
     */
    public function getNamaBahanBakuTerkiniAttribute(): string
    {
        return $this->bahanBaku->nama_bahan_baku ?? $this->id_bahan_baku;
    }

    /**
     * qty x current master price — always up to date with the latest
     * bahan_baku price, per the "master data changes must automatically
     * flow through to every transaction" requirement.
     */
    public function getSubTotalTerkiniAttribute(): float
    {
        return (float) $this->qty * $this->harga_satuan_terkini;
    }
}
