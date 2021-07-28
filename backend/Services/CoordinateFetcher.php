<?php

declare(strict_types=1);

namespace Internships\Services;

use Exception;
use GuzzleHttp\Client;
use Internships\Helpers\OutputWriter;
use Internships\Models\FetchAddress;

class CoordinateFetcher
{
    protected string $mapboxToken;

    public function __construct()
    {
        $this->mapboxToken = $_ENV["MAPBOX_TOKEN"];
    }

    public function coordinatesFromAddress(string &$currentCoordinates, string $address = "", FetchAddress $addressObject = null): bool
    {
        if ($addressObject) {
            $address = $this->fetchAddressToString($addressObject);
        }

        $api = new Client();
        $addressUrl = urlencode($address);

        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/{$addressUrl}.json"
            . "?access_token={$this->mapboxToken}"
            . "&limit=1";

        try {
            $response = $api->get($url);
            $content = json_decode($response->getBody()->getContents(), true);
            $coordinates = $content["features"][0]["geometry"]["coordinates"];
        } catch (Exception $e) {
            OutputWriter::newLineToConsole($e->getMessage());
            OutputWriter::newLineToConsole("Could not fetch coordinates for location {$address}."
            . "Check address or insert coordinates manually.");
            return false;
        }

        $currentCoordinates = "{$coordinates[1]},{$coordinates[0]}";
        return true;
    }

    public function fetchAddressToString(FetchAddress $addressObject)
    {
        return $addressObject->getStreet()
            . $addressObject->getCity()
            . $addressObject->getCountry()
            . $addressObject->getZip();
    }
}
