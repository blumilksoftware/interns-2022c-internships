<?php


namespace Internships\Collectors;


class CityCollector extends UniqueCollector
{
    public function getDestinationRelativePath(): string
    {
        return "/filters/";
    }

    public function getDestinationFileName(): string
    {
        return "cities.json";
    }

    public function jsonSerialize(): array
    {
        return [
            "cities" => $this->collectedContent,
        ];
    }
}