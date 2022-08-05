<?php

declare(strict_types=1);

namespace InternshipsStatic\CommandLine\Commands;

class FetchCommand extends ApplicationCommand
{
    public function getAllowedEnvironment(): array
    {
        return [
            "local",
        ];
    }

    public function getName(): string
    {
        return "fetch";
    }

    public function getApplicationMethod(): string
    {
        return "fetch";
    }

    public function getDescription(): string
    {
        return "Fetches coordinates for companies missing `coordinates` field. ";
    }

    public function getExtendedDescription(): string
    {
        return $this->getDescription()
            . "This command uses external Geocoding api to fetch coordinates from company address. ";
    }

    public function getFailMessage(): string
    {
        return "Your environment might not be able to write to the resource folder. ";
    }
}
