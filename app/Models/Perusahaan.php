<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Perusahaan (supplier company) master data.
 *
 * Mirrors the original `perusahaan` table.
 */
class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $primaryKey = 'id_perusahaan';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_perusahaan',
        'nama_perusahaan',
        'alamat_perusahaan',
        'no_telpon',
        'no_fax',
        'email_perusahaan',
        'nama_penandatangan',
        'jabatan',
        'nama_petugas',
    ];

    /**
     * Purchase notes addressed to this supplier company.
     */
    public function notaPembelian()
    {
        return $this->hasMany(NotaPembelian::class, 'id_perusahaan', 'id_perusahaan');
    }
}
