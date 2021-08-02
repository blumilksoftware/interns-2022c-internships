<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class DocumentConfig implements JsonSerializable
{
    protected int $id;
    protected string $displayedName;
    protected string $filePath;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->displayedName = $data["displayedName"];
        $this->filePath = $data["filePath"];
    }

    public function getFilePath(): mixed
    {
        return $this->filePath;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "displayedName" => $this->displayedName,
            "filePath" => $this->filePath,
        ];
    }
}
