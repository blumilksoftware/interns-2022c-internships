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

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->name = $data["name"];
        $this->address = new Address(
            $data["country"],
            $data["coordinates"],
            $data["street"],
            $data["city"],
            $data["zip"]
        );
        $this->filterData = new FilterData($data["specialization"], $data["tags"]);
        $this->website = $data["website"];
        $this->email = $data["email"];
        $this->phoneNumber = $data["phoneNumber"];
        $this->isPaid = filter_var($data["isPaid"], FILTER_VALIDATE_BOOLEAN);
        $this->logoFile = $data["logoFile"];
    }

    public static function getCompanies(array $csvData): array
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
