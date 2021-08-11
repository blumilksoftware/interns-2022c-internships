<?php

declare(strict_types=1);

namespace Internships\CommandLine\Commands;

use Internships\Interfaces\ApplicationCallable;

abstract class ApplicationCommand extends CommandBase implements ApplicationCallable
{
}
