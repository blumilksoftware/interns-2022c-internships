<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

class CountryCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "country";
    }
}
