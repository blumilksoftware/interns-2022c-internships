<?php

declare(strict_types=1);

namespace Internships\Services;

use Internships\Interfaces\SerializableInfo;
use Internships\Models\Company;
use Internships\Models\PathPair;

class CompanyDataBuilder extends DataBuilder implements SerializableInfo
{
    public function __construct(
        string $workingDirectory,
        PathPair $source,
        Pathpair $destination
    ) {
        parent::__construct($workingDirectory, $source, $destination);
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
                array_push($companies, new Company($i - 1, $entry));
            }
        }
        return $companies;
    }
}
