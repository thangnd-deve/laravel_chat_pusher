<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});


// config pass error 403 when chat private message
/* chat.userId is chat to user id, user is user sender and user Id is user receiver */
Broadcast::channel('chat.{userId}', function ($user, $userId) {
    if ($user != null && $userId == $user->id) {
        return ['id' => $user->id, 'name' => $user->name];
    }
    return false;
});
