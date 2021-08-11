<?php

declare(strict_types=1);

namespace Internships\CommandLine\Commands;

class BuildCommand extends ApplicationCommand
{
    public function getAllowedEnvironment(): array
    {
        return [
            "local",
            "deploy",
        ];
    }

    public function getName(): string
    {
        return "build";
    }

    public function getApplicationMethod(): string
    {
        return "build";
    }

    public function getDescription(): string
    {
        return "Builds static data from resource files. ";
    }

    public function getExtendedDescription(): string
    {
        return $this->getDescription()
            . "This option should build into webpage distribution folder. ";
    }

    public function getFailMessage(): string
    {
        return "This option should be enabled by default. Have you configured COMMANDLINE_MODE environment variable? ";
    }
}
