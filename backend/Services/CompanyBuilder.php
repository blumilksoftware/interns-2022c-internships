<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\PathPair;

class CompanyBuilder extends Builder implements SerializableInfo
{
    public function __construct(
        protected string $workingDirectory
    ) {
        parent::__construct($this->getSource(), $this->getDestination());
    }

    public function buildFromData(array $csvData): array
    {
        $companies = [];
        foreach ($csvData as $i => $rowData) {
            if ($i > 0) {
                $entry = [
                    "name" => $rowData[0],
                    "country" => $rowData[1],
                    "coordinates" => $rowData[2],
                    "street" => $rowData[3],
                    "city" => $rowData[4],
                    "zip" => $rowData[5],
                    "specialization" => $rowData[6],
                    "tags" => $rowData[7],
                    "website" => $rowData[8],
                    "email" => $rowData[9],
                    "phoneNumber" => $rowData[10],
                    "isPaid" => $rowData[11],
                    "logoFile" => $rowData[12],
                ];
                array_push($companies, new Company($i, $entry));
            }
        }
        return $companies;
    }

    public function getSource(): PathPair
    {
        return new PathPair($this->workingDirectory, "companies.csv");
    }

    public function getDestination(): PathPair
    {
        return new PathPair($this->workingDirectory, "companies.json");
    }
}
