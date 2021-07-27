<?php


namespace Internships\Services;

use GuzzleHttp\Client;

class Geocoder
{
    protected string $mapboxToken;

    public function __construct()
    {
        $this->mapboxToken = $_ENV['MAPBOX_TOKEN'];
    }

    public function coordinatesFromAddress(string $address = ""): string
    {
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
}