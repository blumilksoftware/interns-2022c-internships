<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\DocumentConfigFactory;
use Internships\FileSystem\Path;
use Internships\Models\DocumentConfig;

class DocumentResourceTest extends CsvFactoryTestCase
{
    protected function setUp(): void
    {
        static::$dataFactory = new DocumentConfigFactory(static::$validator);
    }

    public function testIfMentionedDocumentsExist(): void
    {
        $files = static::$fileManager->getResourceFilePathsFrom("", static::$dataFactory->getSourceFileName());
        $baseResourcePath = static::$directoryManager->getResourceDirectoryPath("");

        foreach ($files as $file) {
            $fileRelativePath = Path::FOLDER_SEPARATOR . substr($file->getPath(), strlen($baseResourcePath))
                . Path::FOLDER_SEPARATOR;

            /** @var DocumentConfig[] $documentConfigData */
            $documentConfigData = $this->retrieveWithFactory($fileRelativePath, static::$dataFactory->getSourceFileName());

            foreach ($documentConfigData as $documentConfig) {
                $this->checkResourcePath(
                    relativePath: $fileRelativePath,
                    fileName: $documentConfig->getFilePath()
                );
            }
        }
    }
}
