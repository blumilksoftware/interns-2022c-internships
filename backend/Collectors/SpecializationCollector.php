<?php

declare(strict_types=1);

namespace Internships\Collectors;

class SpecializationCollector extends UniqueCollector
{
    public function getJsonTag(): string
    {
        return "specialization";
    }
}
