<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.php.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
