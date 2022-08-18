<?php

declare(strict_types=1);

namespace Internships\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationFetcher
{
    protected const API_URL = "https://api.mapbox.com/geocoding/v5/mapbox.places/";

    protected string $mapboxToken;
    protected PendingRequest $request;
    protected Collection $receivedData;

    public function __construct()
    {
        $this->mapboxToken = env("MAPBOX_TOKEN");
        $this->request = Http::withUserAgent(env("APP_NAME", "Internships"));
    }

    public function query(string $address): self
    {
        $addressAsUrl = urlencode($address);

        $response = $this->request->get(self::API_URL . $addressAsUrl . ".json", [
            "access_token" => $this->mapboxToken,
        ]);

        $this->receivedData = collect($response->json());
        if ($this->receivedData->has("message")) {
            Log::warning("Mapbox response contains message: " . $this->getMessage());
        }

        return $this;
    }


    public function get(): Collection
    {
        return collect($this->receivedData->get("features"))->map(function (array $item) {
           return [
               "place_name" => $item["place_name"],
               "coordinates" => $item["center"],
           ];
        });
    }

    public function getMessage(): string
    {
        return $this->receivedData->get("message");
    }
}
