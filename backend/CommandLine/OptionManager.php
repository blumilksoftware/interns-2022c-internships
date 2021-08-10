<?php

declare(strict_types=1);

namespace Internships\CommandLine;

use Internships\CommandLine\Commands\BuildCommand;
use Internships\CommandLine\Commands\CommandBase;
use Internships\CommandLine\Commands\FetchCommand;
use Internships\CommandLine\Commands\PopulateCommand;

class OptionManager
{
    /** @var CommandBase[] */
    protected array $applicationCommands;

    public function __construct()
    {
        /** @var CommandBase[] $appCommands */
        $appCommands = [
            new BuildCommand(),
            new PopulateCommand(),
            new FetchCommand(),
        ];
        $keys = [];
        foreach($appCommands as $command){
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
        ConsoleWriter::success("Welcome to the Internship's help.");
        ConsoleWriter::print("You can use commandline options to manage and convert resources using php scripts.");
        if($useComposerSyntax){
            ConsoleWriter::warn("It seems you are using composer script. Custom prefix was included in options.");
        }
        ConsoleWriter::print("");
        ConsoleWriter::info("Options for Internship's Static API:");
        $longestNameLength = 0;
        /** @var CommandBase[] $allowedCommands */
        $allowedCommands = [];
        foreach ($this->applicationCommands as $appCommand) {
            if ($appCommand->isAllowed(printReason: false)) {
                $length = strlen($appCommand->getName());
                if($useComposerSyntax){
                    $length+= strlen("intern-");
                }
                if ($longestNameLength < $length) {
                    $longestNameLength = $length;
                }
                array_push($allowedCommands, $appCommand);
            }
        }
        foreach ($allowedCommands as $command) {
            $prettyPrintWrap = $command->getName();
            if($useComposerSyntax){
                $prettyPrintWrap = "intern-" . $prettyPrintWrap;
            }
            $prettyPrintWrap = str_pad(
                string: $prettyPrintWrap,
                length: $longestNameLength,
                pad_type: STR_PAD_LEFT
            );
            ConsoleWriter::print(message: "\t{$prettyPrintWrap}" . "\t\t {$command->getDescription()}");
        }
    }
}
