<?php

namespace App\Models;

use App\Traits\AutoAudit;
use App\Traits\GeneratesDatedId;
use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Nota Pembelian (purchase note) header.
 *
 * Mirrors the original `nota_pembelian` table. Primary key is the
 * `kode_nota` string, auto-generated in the format NP-YYYYMMDD-001 via
 * App\Traits\GeneratesDatedId — never entered manually. Use
 * NotaPembelian::createWithDatedId('kode_nota', 'NP', $data) instead of
 * NotaPembelian::create().
 *
 * `created_by` / `updated_by` / `deleted_by` + timestamps were added on
 * top of the original schema to support the "Riwayat Transaksi"
 * (transaction history) log feature and the full audit trail. Both are
 * stamped automatically (see App\Traits\AutoAudit) — never trusted from
 * request input.
 */
class NotaPembelian extends Model
{
    use AutoAudit, GeneratesDatedId, HasFactory, LogsActivity, SoftDeletesAudited;

    protected $table = 'nota_pembelian';

    protected $primaryKey = 'kode_nota';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'kode_nota',
        'id_perusahaan',
        'id_pegawai',
        'tanggal',
        'informasi',
        'created_by',
        'updated_by',
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
     * The logged-in user (admin or pegawai account) who recorded this
     * transaction — used by the "Riwayat Transaksi" history page.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The logged-in user who last modified this transaction.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * The logged-in user who (soft) deleted this transaction.
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
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
     * Grand total across all line items, computed dynamically from the
     * CURRENT bahan_baku price (qty x harga_bahan_baku terkini) — never
     * from the price stored at the time the item was recorded. This is
     * what makes a master-data price change instantly reflect on every
     * past and present transaction, report, nota, and history page.
     */
    public function getGrandTotalAttribute(): float
    {
        return (float) $this->details->sum(fn (DetailPembelian $d) => $d->sub_total_terkini);
    }

    /**
     * Number of distinct line items on this note (for "Jumlah Item" on
     * the Riwayat Transaksi page).
     */
    public function getJumlahItemAttribute(): int
    {
        return $this->details->count();
    }
}
