<?php

declare(strict_types=1);

namespace Internships\Services;

use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;

class LogoGenerator
{
    public function generateLogoFromName(string $name): string
    {
        $avatar = new Avatar(config("laravolt.avatar"));
        $image = $avatar->create($name);
        $filename = Str::uuid() . ".png";
        $image->save(storage_path("app/public/images/") . $filename);

        return $filename;
    }
}
