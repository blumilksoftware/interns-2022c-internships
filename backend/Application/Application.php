<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\Helpers\OutputWriter;

class Application
{
    public function __construct(
        protected AppGenerator $appGenerator,
    ) {
    }

    public function build(): void
    {
        OutputWriter::newLineToConsole("Building static site...");
        $this->appGenerator->generateStaticData();
    }

    public function populate(): void
    {
        OutputWriter::newLineToConsole("Generating resource files...");
        $this->appGenerator->generateResourceContents();
    }

    public function fetch(): void
    {
        OutputWriter::newLineToConsole("Fetching data...");
        $this->appGenerator->getMissingCoordinatesForCompanies();
    }
}
