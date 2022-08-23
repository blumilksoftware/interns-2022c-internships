<?php

declare(strict_types=1);

namespace Internships\Console\Commands;

use Illuminate\Console\Command;
use Internships\Services\LocationFetcher;

class LocatePlace extends Command
{
    protected $signature = "locate:place {address}";
    protected $description = "Find locations from address with geocoding.";

    public function handle(LocationFetcher $locationFetcher): void
    {
        $this->comment(
            $locationFetcher->query($this->argument("address"))
                ->getLocations()
                ->toJson(JSON_PRETTY_PRINT),
        );
    }
}
