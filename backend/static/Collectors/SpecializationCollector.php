<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

class SpecializationCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "specialization";
    }
}
