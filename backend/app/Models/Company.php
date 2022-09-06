<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Internships\Enums\CompanyStatus;
use Internships\Models\Embeddable\Address;
use Internships\Models\Embeddable\ContactDetails;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property User $user
 * @property Address $address
 * @property string $logo
 * @property ContactDetails $contact_details
 * @property CompanyStatus $status
 * @property bool $has_signed_papers
 */
class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        "name" => "string",
        "description" => "string",
        "address" => Address::class,
        "contact_details" => ContactDetails::class,
        "status" => CompanyStatus::class,
        "has_signed_papers" => "boolean",
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
