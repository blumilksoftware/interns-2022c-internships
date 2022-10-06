<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Internships\Enums\Role;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property Role $role
 * @property string $remember_token
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "password",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "role" => Role::class,
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
