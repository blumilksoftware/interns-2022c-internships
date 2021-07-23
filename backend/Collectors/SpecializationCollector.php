<?php


namespace Internships\Collectors;


class SpecializationCollector extends UniqueCollector
{
    public function getDestinationRelativePath(): string
    {
        return "/filters/";
    }

    public function getDestinationFileName(): string
    {
        return "specializations.json";
    }

    public function jsonSerialize(): array
    {
        return [
            "specializations" => $this->collectedContent,
        ];
    }
}