<?php

namespace App\Models;

use App\Traits\GeneratesId;
use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Pegawai (employee) master data.
 *
 * Mirrors the original `pegawai` table.
 *
 * Soft-deleted (never actually removed) so historical transactions
 * recorded by an employee still resolve their name even after the
 * employee record is "deleted".
 *
 * The primary key is auto-generated (PEG001, PEG002, ...) via
 * App\Traits\GeneratesId — never entered manually. Use
 * Pegawai::createWithAutoId($data) instead of Pegawai::create().
 */
class Pegawai extends Model
{
    use GeneratesId, HasFactory, LogsActivity, SoftDeletesAudited;

    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_pegawai',
        'nama_pegawai',
    ];

    public static function idPrefix(): string
    {
        return 'PEG';
    }

    /**
     * Purchase notes recorded by this employee.
     */
    public function notaPembelian()
    {
        return $this->hasMany(NotaPembelian::class, 'id_pegawai', 'id_pegawai');
    }

    /**
     * Sales invoices recorded by this employee.
     */
    public function invoice()
    {
        return $this->hasMany(InvoicePenjualan::class, 'id_pegawai', 'id_pegawai');
    }

    /**
     * The login account linked to this employee (if any).
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }
}
