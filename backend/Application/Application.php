<?php

declare(strict_types=1);

namespace Internships\Application;

use Internships\FileSystem\CSVReader;
use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\FileManager;
use Internships\Models\Company;

class Application
{
    protected DirectoryManager $directoryManager;
    protected FileManager $fileManager;
    protected CSVReader $csvReader;

    public function __construct(
        string $rootPath,
        string $apiRelativePath,
        string $resourceRelativePath
    ) {
        $this->directoryManager = new DirectoryManager($rootPath, $apiRelativePath, $resourceRelativePath);
        $this->fileManager = new FileManager($this->directoryManager);
        $this->csvReader = new CSVReader();
    }

    public function build(): void
    {
        $jsonPrintFlags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;
        $data = $this->csvReader->getCSVData(
            $this->directoryManager->getResourcePath("/companies/") . "wydzial-techniczny.csv"
        );
        $this->fileManager->create(
            "/wydzial-techniczny",
            "companies.json",
            json_encode(Company::getCompanies($data), $jsonPrintFlags)
        );
    }
}
