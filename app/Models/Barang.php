<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barang (goods) master data.
 *
 * Mirrors the original `barang` table.
 */
class Barang extends Model
{
    use HasFactory;

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
