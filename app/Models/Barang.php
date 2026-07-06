<?php

namespace App\Models;

use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barang (goods) master data.
 *
 * Mirrors the original `barang` table.
 *
 * Soft-deleted (never actually removed from the database) so that
 * historical transactions that reference a product can always still
 * resolve its last known name/price — see the `barang()` relation on
 * DetailInvoicePenjualan, which reads through trashed rows too.
 */
class Barang extends Model
{
    use HasFactory, LogsActivity, SoftDeletesAudited;

    protected $table = 'barang';

    protected $primaryKey = 'id_barang';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'harga_barang',
    ];

    protected $casts = [
        'harga_barang' => 'decimal:2',
    ];

    /**
     * Sales-invoice line items that reference this product.
     */
    public function detailInvoice()
    {
        return $this->hasMany(DetailInvoicePenjualan::class, 'id_barang', 'id_barang');
    }
}
