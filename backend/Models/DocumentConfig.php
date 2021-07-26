<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class DocumentConfig implements JsonSerializable
{
    protected string $displayedName;
    protected string $filePath;

    public function __construct(string $displayedName, string $filePath)
    {
        $this->displayedName = $displayedName;
        $this->filePath = $filePath;
    }

    public function jsonSerialize()
    {
        return [
            "displayedName" => $this->displayedName,
            "filePath" => $this->filePath,
        ];
    }
}
