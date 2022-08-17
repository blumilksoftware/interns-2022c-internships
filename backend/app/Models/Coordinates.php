<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coordinates extends Model
{
    use HasFactory;

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}