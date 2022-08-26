<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Company $companyOriginal
 * @property Company $companyEdited
 * @property string $comment
 */
class Submission extends Model
{
    use HasFactory;

    public function companyOriginal(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_original_id");
    }

    public function companyEdited(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_edited_id");
    }
}
