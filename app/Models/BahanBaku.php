<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Bahan Baku (raw material) master data.
 *
 * Mirrors the original `bahan_baku` table: a string primary key
 * (`id_bahan_baku`) with no auto-increment and no timestamps.
 */
class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';

    protected $primaryKey = 'id_bahan_baku';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_bahan_baku',
        'nama_bahan_baku',
        'harga_bahan_baku',
    ];

    protected $casts = [
        'harga_bahan_baku' => 'decimal:2',
    ];

    /**
     * Purchase-note line items that reference this raw material.
     */
    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_bahan_baku', 'id_bahan_baku');
    }
}
