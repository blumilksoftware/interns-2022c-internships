<?php

declare(strict_types=1);

namespace Internships\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationFetcher
{
    protected string $mapboxToken;
    protected PendingRequest $request;
    protected Collection $receivedData;

    public function __construct()
    {
        $this->mapboxToken = config("services.mapbox.token_public");
        $this->request = Http::withUserAgent(config("app.name"));
    }

    public function query(string $address): self
    {
        $response = $this->request->get(config("services.mapbox.geocode_url") . urlencode($address) . ".json", [
            "access_token" => $this->mapboxToken,
        ]);

        $this->receivedData = collect($response->json());
        if ($this->receivedData->has("message")) {
            Log::warning("Mapbox response contains message: " . $this->getMessage());
        }

        return $this;
    }

    public function getLocations(): Collection
    {
        return collect($this->receivedData->get("features"))
            ->map(function (array $item): array {
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
