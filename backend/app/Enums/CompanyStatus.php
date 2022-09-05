<?php

declare(strict_types=1);

namespace Internships\Enums;

enum CompanyStatus: string
{
    case PendingNew = "pending_new";
    case PendingEdited = "pending_edited";
    case Verified = "verified";

    public function label(): string
    {
        return __($this->value);
    }
}
