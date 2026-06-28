<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Nota Pembelian (purchase note) header.
 *
 * Mirrors the original `nota_pembelian` table. Primary key is the
 * human-entered `kode_nota` string.
 */
class NotaPembelian extends Model
{
    use HasFactory;

    protected $table = 'nota_pembelian';

    protected $primaryKey = 'kode_nota';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'kode_nota',
        'id_perusahaan',
        'id_pegawai',
        'tanggal',
        'informasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    /**
     * Line items belonging to this purchase note.
     */
    public function details()
    {
        return $this->hasMany(DetailPembelian::class, 'kode_nota', 'kode_nota');
    }

    /**
     * The raw materials on this note (many-to-many via detail_pembelian).
     */
    public function bahanBaku()
    {
        return $this->belongsToMany(
            BahanBaku::class,
            'detail_pembelian',
            'kode_nota',
            'id_bahan_baku',
            'kode_nota',
            'id_bahan_baku'
        )->withPivot(['qty', 'harga_satuan', 'sub_total', 'total_harga', 'keterangan']);
    }

    /**
     * Grand total across all line items (sum of total_harga).
     */
    public function getGrandTotalAttribute(): float
    {
        return (float) $this->details->sum('total_harga');
    }
}
