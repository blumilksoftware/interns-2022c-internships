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

    public function testIfRootPathsAreValid(){
        $fullApiPath = static::$directoryManager->getApiPath();
        $fullResourcePath = static::$directoryManager->getResourcePath();
        $this->assertSame("/application/testing/Backend/../Fixtures/api/", $fullApiPath);
        $this->assertSame("/application/testing/Backend/../Fixtures/resources/", $fullResourcePath);
    }

    public function testRelativePathSanitization(){
        $relativePathIdentity = new RelativePathIdentity(
            leftBasePath: "leftPath",
            relativeChangingPath: "middlePath///",
            rightBasePath: "///rightPath///",
            sourceName: "/sourceFile.csv",
            destinationName: "destinationFile.json//");

        $this->assertSame("/leftPath/middlePath/rightPath/", $relativePathIdentity->getRelativePath());
        $this->assertSame("sourceFile.csv", $relativePathIdentity->getSourceName());
        $this->assertSame("destinationFile.json", $relativePathIdentity->getDestinationName());
    }

    public function testFullPathIdentityCreation(){
        $relativePathIdentity = new RelativePathIdentity(
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json");

        $fullIdentity = static::$directoryManager->getFullPathIdentity($relativePathIdentity);
        $this->assertSame("/application/testing/Backend/../Fixtures/api/",
                          $fullIdentity->getFullDestinationPath());
        $this->assertSame("/application/testing/Backend/../Fixtures/resources/",
                          $fullIdentity->getFullSourcePath());

        $this->assertSame("sourceFile.csv", $fullIdentity->getSourceName());
        $this->assertSame("destinationFile.json", $fullIdentity->getDestinationName());

        $this->assertSame("/application/testing/Backend/../Fixtures/resources/sourceFile.csv",
                          $fullIdentity->getFullSourceFilePath());
        $this->assertSame("/application/testing/Backend/../Fixtures/api/destinationFile.json",
                          $fullIdentity->getFullDestinationFilePath());
    }

    public function testResourceDestinationFullPath(){
        $relativePathIdentity = new RelativePathIdentity(
            leftBasePath: "/leftPath/",
            relativeChangingPath: "/middlePath/",
            rightBasePath: "/rightPath/",
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json");

        $fullIdentity = static::$directoryManager->getFullPathIdentity($relativePathIdentity,
            destinationToResource: true);

        $this->assertSame($fullIdentity->getSourceName(), $fullIdentity->getDestinationName());
        $this->assertSame("sourceFile.csv", $fullIdentity->getDestinationName());
        $this->assertSame($fullIdentity->getFullSourcePath(), $fullIdentity->getFullDestinationPath());
        $this->assertSame("/application/testing/Backend/../Fixtures/resources/leftPath/middlePath/rightPath/",
                          $fullIdentity->getFullDestinationPath());
    }

    public function testIfMissingParentReturnsEmptyString(){
        $relativePathIdentity = new RelativePathIdentity();
        $this->assertSame("", $relativePathIdentity->getParentPath());
    }

    public function testIfPathIdentityAppendsParent(){
        $parentRelativeIdentity = new RelativePathIdentity(relativeChangingPath: "/parent/");
        $relativePathIdentity = new RelativePathIdentity(
            relativeChangingPath: "/child/",
            sourceName: "sourceFile.csv",
            destinationName: "destinationFile.json");
        $relativePathIdentity->setParentIdentity($parentRelativeIdentity);

        $this->assertSame("/parent/child/", $relativePathIdentity->getRelativePath());
    }
}