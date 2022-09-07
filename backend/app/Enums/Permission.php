<?php

declare(strict_types=1);

namespace Internships\Enums;

enum Permission: string
{
    case ManageUsers = "manage_users";
    case ManageCompanies = "manage_companies";

    public function label(): string
    {
        return __($this->value);
    }
}
