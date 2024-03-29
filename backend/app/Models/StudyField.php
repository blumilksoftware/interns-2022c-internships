<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Department $department
 */
class StudyField extends Model
{
    use HasFactory;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function specializations(): HasMany
    {
        return $this->hasMany(Specialization::class);
    }
}
