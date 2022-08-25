<?php

declare(strict_types=1);

namespace Internships\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class Department extends Model
{
    use HasFactory;

    public function studyFields(): HasMany
    {
        return $this->hasMany(StudyField::class);
    }
}
