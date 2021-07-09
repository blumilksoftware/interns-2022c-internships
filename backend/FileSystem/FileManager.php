<?php

namespace Internships\FileSystem;

class FileManager
{
    protected DirectoryManager $directoryManager;

    public function __construct(
        protected string $rootDirectoryPath
    ) {
        $this->directoryManager = new DirectoryManager($rootDirectoryPath);
    }

    public function create(string $relativePath, string $filename = "\0", mixed $content = "") : void
    {
        $path = $this->directoryManager->getApiPath($relativePath);

        if($filename != "\0"){
            file_put_contents(
                filename: $path . $filename,
                data: $content);
        }
    }
}
