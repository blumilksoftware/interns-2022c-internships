<?php

declare(strict_types=1);

namespace InternshipsStatic\CommandLine\Commands;

class PopulateCommand extends ApplicationCommand
{
    public function getAllowedEnvironment(): array
    {
        return [
            "local",
        ];
    }

    public function getName(): string
    {
        return "populate";
    }

    public function getApplicationMethod(): string
    {
        return "populate";
    }

    public function getDescription(): string
    {
        return "Creates resource structure from template files.";
    }

    public function getExtendedDescription(): string
    {
        return $this->getDescription()
            . "Useful when you are setting up the project environment. It allows you to quickly create necessary files.";
    }

    public function getFailMessage(): string
    {
        return "Your environment might not be able to write to the resource folder. ";
    }
}
