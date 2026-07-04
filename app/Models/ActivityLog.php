<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * activity_logs — audit trail of create/update/delete actions performed
 * on tracked models (see App\Traits\LogsActivity).
 */
class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_user',
        'role',
        'aktivitas',
        'tabel',
        'record_id',
        'data_lama',
        'data_baru',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $log) {
            $log->created_at ??= now();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Decode the "before" snapshot into an associative array.
     */
    public function getDataLamaArrayAttribute(): ?array
    {
        return $this->data_lama ? json_decode($this->data_lama, true) : null;
    }

    /**
     * Decode the "after" snapshot into an associative array.
     */
    public function getDataBaruArrayAttribute(): ?array
    {
        return $this->data_baru ? json_decode($this->data_baru, true) : null;
    }
}
