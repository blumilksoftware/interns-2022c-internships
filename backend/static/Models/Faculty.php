<?php

declare(strict_types=1);

namespace InternshipsStatic\Models;

use JsonSerializable;

class Faculty implements JsonSerializable
{
    protected string $name;
    protected string $directory;

    public function __construct(
        protected int $id,
        array $data,
    ) {
        $this->name = $data["name"];
        $this->directory = $data["directory"];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "directory" => $this->directory,
        ];
    }
}
