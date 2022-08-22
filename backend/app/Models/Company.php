<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Internships\Models\Embeddable\Address;
use Internships\Models\Embeddable\ContactDetails;

class Company extends Model
{
    use HasFactory;

    protected $casts = [
        "address" => Address::class,
        "contact_details" => ContactDetails::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class);
    }
}
