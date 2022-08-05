<?php

declare(strict_types=1);

namespace InternshipsStatic\Application;

use InternshipsStatic\CommandLine\ConsoleWriter;

class Application
{
    public function __construct(
        protected AppGenerator $appGenerator,
    ) {}

    public function build(): void
    {
        ConsoleWriter::info("Building static site...");
        $this->appGenerator->generateStaticData();
    }

    public function populate(): void
    {
        ConsoleWriter::info("Generating resource files...");
        $this->appGenerator->generateResourceContents();
    }

    public function fetch(): void
    {
        ConsoleWriter::info("Fetching data...");
        $this->appGenerator->getMissingCoordinatesForCompanies();
    }
}
