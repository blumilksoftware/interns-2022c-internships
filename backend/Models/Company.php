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
    protected Socials $socialMedia;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->name = $data["name"];
        $this->address = new Address(
            $data["country"],
            $data["coordinates"],
            $data["street"],
            $data["zip"],
            $data["city"]
        );
        $this->filterData = new FilterData($data["specialization"], $data["tags"]);
        $this->website = $data["website"];
        $this->email = $data["email"];
        $this->phoneNumber = $data["phoneNumber"];
        $this->isPaid = $data["isPaid"];
        $this->logoFile = $data["logoFile"];
        $this->socialMedia = new Socials(
            $data["socialsFacebook"],
            $data["socialsLinkedIn"]
        );
    }

    public function getId(): int
    {
        return $this->id;
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
            "socialMedia" => $this->socialMedia,
        ];
    }
}
