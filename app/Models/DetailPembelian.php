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

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku', 'id_bahan_baku');
    }
}
