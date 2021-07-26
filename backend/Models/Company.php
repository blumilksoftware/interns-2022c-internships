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
    protected string $isPaid;
    protected string $logoFile;
    protected string $socialsFacebook;
    protected string $socialsLinkedIn;

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
        $this->isPaid = $data["isPaid"];
        $this->logoFile = $data["logoFile"];
        $this->socialsFacebook = $data["socialsFacebook"];
        $this->socialsLinkedIn = $data["socialsLinkedIn"];
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
            "facebook" => $this->socialsFacebook,
            "linkedIn" => $this->socialsLinkedIn,
        ];
    }
}
