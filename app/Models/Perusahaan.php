<?php

namespace App\Models;

use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Perusahaan (supplier company) master data.
 *
 * Mirrors the original `perusahaan` table.
 *
 * Soft-deleted (never actually removed) so historical purchase notes
 * still resolve the supplier's details even after it's "deleted".
 */
class Perusahaan extends Model
{
    use HasFactory, LogsActivity, SoftDeletesAudited;

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
