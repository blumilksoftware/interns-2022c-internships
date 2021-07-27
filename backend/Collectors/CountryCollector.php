<?php

declare(strict_types=1);

namespace Internships\Collectors;

class CountryCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "country";
    }
}
