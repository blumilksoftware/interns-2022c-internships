<?php

declare(strict_types=1);

namespace Internships\Application;

class Application
{
    public function __construct(
        protected AppGenerator $appGenerator,
    ) {
    }

    public function build(): void
    {
        echo "Building static site..." . PHP_EOL;
        $this->appGenerator->generateStaticData();
    }

    public function populate(): void
    {
        echo "Generating resource files..." . PHP_EOL;
        $this->appGenerator->generateResourceContents();
    }
}
