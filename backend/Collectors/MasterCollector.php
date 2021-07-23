<?php


namespace Internships\Collectors;

use Internships\FileSystem\FileManager;
use Internships\FileSystem\Path;

abstract class MasterCollector
{
    /* @var $collectors UniqueCollector[] */
    protected array $collectors;
    protected string $masterFolder;

    protected function __construct(protected FileManager $fileManager)
    {
        $this->collectors = [];
    }

    public function saveToJson() : void
    {
        foreach ($this->collectors as $collector){
            $destinationRelativePath = $this->masterFolder
                . Path::FOLDER_SEPARATOR
                . $collector->getDestinationRelativePath();

            $this->fileManager->create(
                $destinationRelativePath,
                $collector->getDestinationFileName(),
                json_encode($collector, $this->fileManager->getDefaultJsonFlags())
            );
        }
    }
}