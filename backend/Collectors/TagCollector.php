<?php


namespace Internships\Collectors;


class TagCollector extends UniqueCollector
{
    public function getDestinationRelativePath(): string
    {
        return "/filters/";
    }

    public function getDestinationFileName(): string
    {
        return "tags.json";
    }

    public function jsonSerialize(): array
    {
        return [
            "tags" => $this->collectedContent,
        ];
    }
}