<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

class TagCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "tags";
    }
}
