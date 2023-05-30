<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];
    
    public function isAdmin() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->isAdmin(),
        );
    }

    public function isUser() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->isUser(),
        );
    }

    public function scopeUser(Builder $query): void
    {
        $query->where('role', UserRole::USER->value);
    }

    public function scopeAdmin(Builder $query): void
    {
        $query->where('role', UserRole::ADMIN->value);
    }

    public function scopeAdminAndSuperAdmin(Builder $query): void
    {
        $query->whereIn('role', [UserRole::ADMIN->value, UserRole::SUPERADMIN->value]);
    }

    public function scopeVerified(Builder $query): void
    {
        $query->where('email_verified_at', '!=', null);
    }

    public function hasNotVerifiedEmail() : bool
    {
        return $this->email_verified_at != NULL;
    }
}
