<?php

namespace App\Models;

use App\Traits\GeneratesId;
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
 *
 * The primary key is auto-generated (CUST001, CUST002, ...) via
 * App\Traits\GeneratesId — never entered manually. Use
 * Customer::createWithAutoId($data) instead of Customer::create().
 */
class Customer extends Model
{
    use GeneratesId, HasFactory, LogsActivity, SoftDeletesAudited;

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

    public static function idPrefix(): string
    {
        return 'CUST';
    }

    /**
     * Sales invoices issued to this customer.
     */
    public function invoice()
    {
        return $this->hasMany(InvoicePenjualan::class, 'id_customer', 'id_customer');
    }
}
