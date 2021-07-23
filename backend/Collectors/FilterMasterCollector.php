<?php


namespace Internships\Collectors;


use Internships\FileSystem\FileManager;

class FilterMasterCollector extends MasterCollector
{
    public function __construct(string $workingDirectory, protected FileManager $fileManager)
    {
        parent::__construct($fileManager);

        $this->masterFolder = $workingDirectory;
        $this->collectors = [
            new CityCollector(),
            new SpecializationCollector(),
            new TagCollector(),
        ];
    }
}