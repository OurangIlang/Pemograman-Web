<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Authentication account.
 *
 * The original PHP-native project authenticated against the `pegawai`
 * table (by employee name) with a hard-coded `admin` / `admin123`
 * fallback. Laravel's authentication system requires a dedicated
 * credential store, so a lightweight `users` table backs login here.
 * The seeder recreates the original accounts: one `admin` super-user and
 * one login row per employee. Roles preserve the original multi-role
 * intent ("admin" vs "pegawai").
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'id_pegawai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * The employee record this login is linked to (if any).
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    /**
     * Convenience role check used by the role middleware and views.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
