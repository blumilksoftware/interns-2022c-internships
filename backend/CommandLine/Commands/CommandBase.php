<?php

declare(strict_types=1);

namespace Internships\CommandLine\Commands;

use Internships\CommandLine\ConsoleWriter;
use Internships\Interfaces\CommandLineCallable;

abstract class CommandBase implements CommandLineCallable
{
    public function isAllowed(bool $printReason = true): bool
    {
        $commandEnvironment = $_ENV["COMMANDLINE_MODE"];
        foreach ($this->getAllowedEnvironment() as $environment) {
            if ($environment === strtolower($commandEnvironment)) {
                return true;
            }
        }
        if ($printReason) {
            ConsoleWriter::warn("{$this->getName()} is a recognized option, but is not supported. ");
            ConsoleWriter::print($this->getFailMessage());
        }
        return false;
    }
}
