<?php

namespace App\Models;

use App\Traits\AutoAudit;
use App\Traits\GeneratesId;
use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Perusahaan (supplier company) master data.
 *
 * Mirrors the original `perusahaan` table, extended with a fuller set
 * of company fields (kota, provinsi, kode_pos, PIC, NPWP, keterangan,
 * status_aktif) plus created_by/updated_by for a complete audit trail.
 *
 * Soft-deleted (never actually removed) so historical purchase notes
 * still resolve the supplier's details even after it's "deleted".
 *
 * The primary key is auto-generated (PER001, PER002, ...) via
 * App\Traits\GeneratesId — never entered manually. Use
 * Perusahaan::createWithAutoId($data) instead of Perusahaan::create().
 */
class Perusahaan extends Model
{
    use AutoAudit, GeneratesId, HasFactory, LogsActivity, SoftDeletesAudited;

    protected $table = 'perusahaan';

    protected $primaryKey = 'id_perusahaan';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_perusahaan',
        'nama_perusahaan',
        'alamat_perusahaan',
        'kota',
        'provinsi',
        'kode_pos',
        'no_telpon',
        'no_fax',
        'email_perusahaan',
        'nama_penandatangan',
        'jabatan',
        'nama_petugas',
        'pic',
        'npwp',
        'keterangan',
        'status_aktif',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public static function idPrefix(): string
    {
        return 'PER';
    }

    /**
     * Purchase notes addressed to this supplier company.
     */
    public function notaPembelian()
    {
        return $this->hasMany(NotaPembelian::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
