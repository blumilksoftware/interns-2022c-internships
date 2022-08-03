<?php

declare(strict_types=1);

namespace InternshipsStatic\Collectors;

use InternshipsStatic\FileSystem\FileManager;
use InternshipsStatic\FileSystem\RelativePathIdentity;

class FilterMainCollector extends MainCollector
{
    public function __construct(FileManager $fileManager, RelativePathIdentity $parentPathIdentity)
    {
        $this->collectorClassNames = [
            CountryCollector::class,
            CityCollector::class,
            SpecializationCollector::class,
            TagCollector::class,
        ];
        $this->pathIdentity = new RelativePathIdentity(destinationName:"filters.json");
        parent::__construct($fileManager, $parentPathIdentity);
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
