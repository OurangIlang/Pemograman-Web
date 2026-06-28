<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Customer master data.
 *
 * Mirrors the original `customer` table.
 */
class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $primaryKey = 'id_customer';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'nama_customer',
        'nama_pt',
        'alamat_pt',
    ];

    /**
     * Sales invoices issued to this customer.
     */
    public function invoice()
    {
        return $this->hasMany(InvoicePenjualan::class, 'id_customer', 'id_customer');
    }
}
