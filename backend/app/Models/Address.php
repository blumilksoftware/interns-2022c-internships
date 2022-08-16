<?php

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    public function coordinates(): BelongsTo
    {
        return $this->belongsTo(Coordinates::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
