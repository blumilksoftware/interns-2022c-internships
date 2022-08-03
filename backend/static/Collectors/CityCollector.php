<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

class CityCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "city";
    }
}
