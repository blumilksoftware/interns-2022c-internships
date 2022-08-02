<?php

declare(strict_types=1);

namespace Internships\Testing\Integrity;

use Internships\Factories\DocumentConfigFactory;
use Internships\Models\DocumentConfig;

class DocumentResourceTest extends CsvFactoryTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$dataFactory = new DocumentConfigFactory(static::$fileManager, static::$validator);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$dataFactory = null;
    }

    public function testIfMentionedDocumentsExist(): void
    {
        $relativePath = static::$dataFactory->getRelativePathIdentity();
        $files = static::$fileManager->getResourceFilePathsFrom("", $relativePath->getSourceName());

        $resourcePath = static::$directoryManager->getResourcePath();
        foreach ($files as $file) {
            $fileParentPath = $resourcePath . $file->getRelativePath();
            /** @var array<DocumentConfig> $documentConfigData */
            $documentConfigData = $this->retrieveWithFactory($file);

            foreach ($documentConfigData as $documentConfig) {
                $this->assertFileExists($fileParentPath . $documentConfig->getFilePath());
            }
        }
    }
}
