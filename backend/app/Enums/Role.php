<?php

declare(strict_types=1);

namespace Internships\Enums;

enum Role: string
{
    case Administrator = "administrator";
    case Moderator = "moderator";
    case Company = "company";
    case Banned = "banned";
}
