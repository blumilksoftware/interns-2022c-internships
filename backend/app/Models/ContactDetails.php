<?php

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactDetails extends Model
{
    use HasFactory;

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
