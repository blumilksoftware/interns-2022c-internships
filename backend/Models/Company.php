<?php

declare(strict_types=1);

namespace Internships\Models;

use JsonSerializable;

class Company implements JsonSerializable
{
    protected int $id;
    protected string $name;
    protected Address $address;
    protected FilterData $filterData;
    protected string $website;
    protected string $email;
    protected string $phoneNumber;
    protected bool $isPaid;
    protected string $logoFile;

    public function __construct(int $id, array $rowData)
    {
        $this->id = $id;
        $this->name = $rowData[0];
        $this->address = new Address(
            $rowData[1],
            $rowData[2],
            $rowData[3],
            $rowData[4],
            $rowData[5]
        );
        $this->filterData = new FilterData($rowData[6], $rowData[7]);
        $this->website = $rowData[8];
        $this->email = $rowData[9];
        $this->phoneNumber = $rowData[10];
        $this->isPaid = filter_var($rowData[11], FILTER_VALIDATE_BOOLEAN);
        $this->logoFile = $rowData[12];
    }

    public static function getCompanies(array $csvData): array
    {
        $companies = [];
        foreach ($csvData as $i => $entry) {
            if ($i > 0) {
                array_push($companies, new self($i, $entry));
            }
        }
        return $companies;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "address" => $this->address,
            "filterData" => $this->filterData,
            "website" => $this->website,
            "email" => $this->email,
            "phoneNumber" => $this->phoneNumber,
            "isPaid" => $this->isPaid,
            "logoFile" => $this->logoFile,
        ];
    }
}
