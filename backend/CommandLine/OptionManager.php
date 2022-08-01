<?php

declare(strict_types=1);

namespace Internships\CommandLine;

use Internships\CommandLine\Commands\ApplicationCommand;
use Internships\CommandLine\Commands\BuildCommand;
use Internships\CommandLine\Commands\FetchCommand;
use Internships\CommandLine\Commands\PopulateCommand;

class OptionManager
{
    /** @var array<ApplicationCommand> */
    protected array $applicationCommands;

    protected string $composerPrefix = "intern_";

    public function __construct()
    {
        /** @var array<ApplicationCommand> $appCommands */
        $appCommands = [
            new BuildCommand(),
            new PopulateCommand(),
            new FetchCommand(),
        ];
        $keys = [];
        foreach ($appCommands as $command) {
            array_push($keys, $command->getName());
        }
        $this->applicationCommands = array_combine($keys, $appCommands);
    }

    public function getCommands()
    {
        $keys = array_keys($this->applicationCommands);
        array_push($keys, "help", "composer");
        return $keys;
    }

    public function getApplicationOption(array $options, string &$methodName): bool
    {
        $useComposerSyntax = array_key_exists("composer", $options);
        if (array_key_exists("help", $options)) {
            $this->printHelpForAllowed($useComposerSyntax);
            return false;
        }

        $applicationOptionKeyFound = 0;
        foreach ($this->applicationCommands as $appCommand) {
            $commandName = $appCommand->getName();
            if (array_key_exists($commandName, $options)) {
                $methodName = $commandName;
                $applicationOptionKeyFound++;
            }
            if ($applicationOptionKeyFound > 1) {
                ConsoleWriter::warn("Only one application option can be used at the time. ");
                return false;
            }
        }

        if ($applicationOptionKeyFound === 1) {
            return true;
        }

        $this->printHelpForAllowed($useComposerSyntax);
        ConsoleWriter::warn("Help information was shown, because you didn't specify any defined option. ");
        return false;
    }

    protected function printHelpForAllowed(bool $useComposerSyntax): void
    {
        ConsoleWriter::print("");
        ConsoleWriter::success("Welcome to the Internship's help.");
        ConsoleWriter::print("");

        ConsoleWriter::print("You can use commandline options to manage and convert resources using php scripts.");
        $redReminderText = ColorText::colorize(
            escapeColor: ColorText::getEscapedColor(ColorText::TEXT_RED),
            message: "Remember:",
        );
        ConsoleWriter::print("{$redReminderText} Static API cannot be build with incomplete data set.");
        ConsoleWriter::print("");

        ConsoleWriter::info("Options for Internship's Static API:");
        if ($useComposerSyntax) {
            ConsoleWriter::warn("(It seems you are using composer script. Custom prefix was included in options.)");
        }
        $longestNameLength = 0;
        /** @var array<ApplicationCommand> $allowedCommands */
        $allowedCommands = [];
        foreach ($this->applicationCommands as $appCommand) {
            if ($appCommand->isAllowed(printReason: false)) {
                $length = strlen($appCommand->getName());
                if ($useComposerSyntax) {
                    $length += strlen($this->composerPrefix);
                }
                if ($longestNameLength < $length) {
                    $longestNameLength = $length;
                }
                array_push($allowedCommands, $appCommand);
            }
        }
        foreach ($allowedCommands as $command) {
            $prettyPrintWrap = $command->getName();
            if ($useComposerSyntax) {
                $prettyPrintWrap = $this->composerPrefix . $prettyPrintWrap;
            }
            $prettyPrintWrap = str_pad(
                string: $prettyPrintWrap,
                length: $longestNameLength,
                pad_type: STR_PAD_LEFT,
            );
            $prettyPrintWrap = ColorText::colorize(
                escapeColor: ColorText::getEscapedColor(ColorText::TEXT_GREEN),
                message: $prettyPrintWrap,
            );
            ConsoleWriter::print(message: "\t{$prettyPrintWrap}" . "\t\t {$command->getDescription()}");
        }
        ConsoleWriter::print("");
    }
}
