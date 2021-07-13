<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Faculty implements JsonSerializable
{
    protected int $id;
    protected string $name;
    protected string $directory;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
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

    public function getSource(): PathPair
    {
        return new PathPair("/faculties/", "faculty.csv");
    }

    public function getDestination(): PathPair
    {
        return new PathPair("/faculties/", "faculty.json");
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
