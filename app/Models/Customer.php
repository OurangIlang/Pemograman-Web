<?php

namespace App\Models;

use App\Traits\LogsActivity;
use App\Traits\SoftDeletesAudited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Customer master data.
 *
 * Mirrors the original `customer` table.
 *
 * Soft-deleted (never actually removed) so historical sales invoices
 * keep referencing a valid customer record even after it's "deleted".
 */
class Customer extends Model
{
    use HasFactory, LogsActivity, SoftDeletesAudited;

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
