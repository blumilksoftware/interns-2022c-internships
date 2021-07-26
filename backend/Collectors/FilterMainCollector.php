<?php

declare(strict_types=1);

namespace Internships\Collectors;

use Internships\FileSystem\FileManager;

class FilterMainCollector extends MainCollector
{
    public function __construct(FileManager $fileManager)
    {
        $this->collectorClassNames = [
            CountryCollector::class,
            CityCollector::class,
            SpecializationCollector::class,
            TagCollector::class,
        ];
        $this->relativeSavingPath = "";
        $this->filename = "filters.json";
        parent::__construct($fileManager);
    }

    public function getCountryCollector(): CountryCollector
    {
        return $this->collectors[CountryCollector::class];
    }

    public function getCityCollector(): CityCollector
    {
        return $this->collectors[CityCollector::class];
    }

    public function getSpecializationCollector(): SpecializationCollector
    {
        return $this->collectors[SpecializationCollector::class];
    }

    public function getTagCollector(): TagCollector
    {
        return $this->collectors[TagCollector::class];
    }
}
