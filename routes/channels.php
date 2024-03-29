<?php

use App\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.*', function () {
    return true;
});

Broadcast::channel('chat', function () {
    return true;
});

Broadcast::channel('stk.{userId}', function ($user, $userId) {
    return $user->id === User::findOrNew($userId)->id;
});
