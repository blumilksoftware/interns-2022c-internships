<?php

declare(strict_types=1);

namespace InternshipsStatic\CommandLine\Commands;

use InternshipsStatic\Interfaces\ApplicationCallable;

abstract class ApplicationCommand extends CommandBase implements ApplicationCallable
{
}
