<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * login_logs — one row per login session: who logged in, from where,
 * and (once they log out) when the session ended.
 */
class LoginLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_user',
        'role',
        'login_at',
        'logout_at',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
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
}
