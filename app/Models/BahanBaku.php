<?php

namespace App\Models;

use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Bahan Baku (raw material) master data.
 *
 * Mirrors the original `bahan_baku` table: a string primary key
 * (`id_bahan_baku`) with no auto-increment and no timestamps.
 *
 * Soft-deleted (never actually removed from the database) so that
 * historical transactions that reference a raw material can always
 * still resolve its last known name/price — see the `bahanBaku()`
 * relation on DetailPembelian, which reads through trashed rows too.
 */
class BahanBaku extends Model
{
    use HasFactory, LogsActivity, SoftDeletesAudited;

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
