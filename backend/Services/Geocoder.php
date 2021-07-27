<?php


namespace Internships\Services;

use GuzzleHttp\Client;
use Internships\Models\FetchAddress;

class Geocoder
{
    protected string $mapboxToken;

    public function __construct()
    {
        $this->mapboxToken = $_ENV['MAPBOX_TOKEN'];
    }

    public function coordinatesFromAddress(string $address = "", FetchAddress $addressObject = null): string
    {
        if($addressObject){
            $address = $this->fetchAddressToString($addressObject);
        }

        $api = new Client();
        $addressUrl = urlencode($address);

        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/{$addressUrl}.json"
            . "?access_token={$this->mapboxToken}"
            . "&limit=1";

        $response = $api->get($url);
        $coordinates = json_decode($response->getBody()->getContents(), true)["features"][0]["geometry"]["coordinates"];
        $latitudeFirst = "{$coordinates[1]},{$coordinates[0]}";

        return $latitudeFirst;
    }

    public function fetchAddressToString(FetchAddress $addressObject){
        return $addressObject->getStreet()
            . $addressObject->getCity()
            . $addressObject->getCountry()
            . $addressObject->getZip();
    }
}