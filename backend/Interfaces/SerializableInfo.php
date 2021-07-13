<?php

declare(strict_types=1);

namespace Internships\Interfaces;

use Internships\Models\PathPair;

interface SerializableInfo
{
    public function getSource(): PathPair;

    public function getDestination(): PathPair;
}
