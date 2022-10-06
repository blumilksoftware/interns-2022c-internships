<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel("App.User.php.User.{id}", fn($user, $id) => (int)$user->id === (int)$id);
