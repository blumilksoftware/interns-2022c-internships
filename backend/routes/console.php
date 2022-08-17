<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Internships\Services\LocationFetcher;
use Symfony\Component\Console\Input\InputArgument;

Artisan::command("inspire", function (): void {
    $this->comment(Inspiring::quote());
})->purpose("Display an inspiring quote");

Artisan::command("locate", function (string $address): void {
    $this->comment(
        (new LocationFetcher())
            ->query($address)
            ->get()
            ->toJson(JSON_PRETTY_PRINT),
    );
})->addArgument("address", InputArgument::REQUIRED, "Address of location.")
    ->purpose("Find locations from address using MapBox API.");
