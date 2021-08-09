<?php


use Internships\FileSystem\DirectoryManager;
use Internships\FileSystem\RelativePathIdentity;
use PHPUnit\Framework\TestCase;

class DirectoryManagerTest extends TestCase
{
    protected static ?DirectoryManager $directoryManager;

    public static function setUpBeforeClass(): void
    {
        static::$directoryManager = new DirectoryManager(
            rootDirectoryPath: __DIR__ . "/../",
            relativeApiPath: "/Fixtures/api/",
            relativeResourcePath: "/Fixtures/resources/");
    }

    public static function tearDownAfterClass(): void
    {
        static::$directoryManager = null;
    }

    public function testIfRootPathsAreValid()
    {
        $fullApiPath = static::$directoryManager->getApiPath();
        $fullResourcePath = static::$directoryManager->getResourcePath();
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/api/",
            actual: $fullApiPath
        );
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/resources/",
            actual: $fullResourcePath
        );
    }

    public function testRelativePathSanitization()
    {
        $relativePathIdentity = new RelativePathIdentity(
            leftBasePath: "leftPath",
            relativeChangingPath: "middlePath///",
            rightBasePath: "///rightPath///",
            sourceName: "/sourceFile.csv",
            destinationName: "destinationFile.json//"
        );

        $this->assertSame(
            expected: "/leftPath/middlePath/rightPath/",
            actual: $relativePathIdentity->getRelativePath()
        );
        $this->assertSame(
            expected: "sourceFile.csv",
            actual: $relativePathIdentity->getSourceName()
        );
        $this->assertSame(
            expected: "destinationFile.json",
            actual: $relativePathIdentity->getDestinationName()
        );
    }

    public function testFullPathIdentityPaths()
    {
        $relativePathIdentity = new RelativePathIdentity(
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json"
        );
        $fullIdentity = static::$directoryManager->getFullPathIdentity($relativePathIdentity);

        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/api/",
            actual: $fullIdentity->getFullDestinationPath()
        );
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/resources/",
            actual: $fullIdentity->getFullSourcePath()
        );
        $this->assertSame(
            expected: "sourceFile.csv",
            actual: $fullIdentity->getSourceName()
        );
        $this->assertSame(
            expected: "destinationFile.json",
            actual: $fullIdentity->getDestinationName()
        );
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/resources/sourceFile.csv",
            actual: $fullIdentity->getFullSourceFilePath()
        );
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/api/destinationFile.json",
            actual: $fullIdentity->getFullDestinationFilePath()
        );
    }

    public function testResourceDestinationFullPath()
    {
        $relativePathIdentity = new RelativePathIdentity(
            leftBasePath: "/leftPath/",
            relativeChangingPath: "/middlePath/",
            rightBasePath: "/rightPath/",
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json"
        );

        $fullIdentity = static::$directoryManager->getFullPathIdentity(
            $relativePathIdentity,
            destinationToResource: true
        );

        $this->assertSame(
            expected: $fullIdentity->getSourceName(),
            actual: $fullIdentity->getDestinationName()
        );
        $this->assertSame(
            expected: "sourceFile.csv",
            actual: $fullIdentity->getDestinationName()
        );
        $this->assertSame(
            expected: $fullIdentity->getFullSourcePath(),
            actual: $fullIdentity->getFullDestinationPath()
        );
        $this->assertSame(
            expected: "/application/testing/Backend/../Fixtures/resources/leftPath/middlePath/rightPath/",
            actual: $fullIdentity->getFullDestinationPath()
        );
    }

    public function testIfMissingParentReturnsEmptyString()
    {
        $relativePathIdentity = new RelativePathIdentity();
        $this->assertSame(
            expected: "",
            actual: $relativePathIdentity->getParentPath()
        );
    }

    public function testIfPathIdentityAppendsParent()
    {
        $relativePathIdentity = new RelativePathIdentity(
            relativeChangingPath: "/child/",
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json"
        );

        $relativePathIdentity->setParentIdentity(
            new RelativePathIdentity(relativeChangingPath: "/parent/")
        );

        $this->assertSame(
            expected: "/parent/child/",
            actual: $relativePathIdentity->getRelativePath()
        );
    }
}