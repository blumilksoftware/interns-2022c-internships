<?php

declare(strict_types=1);

namespace Internships\Collectors;

class TagCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "tags";
    }
}
