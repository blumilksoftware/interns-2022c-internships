<?php

declare(strict_types=1);

namespace Internships\Interfaces;

interface BuildTool
{
    public function buildFromData(array $csvData): array;
}
