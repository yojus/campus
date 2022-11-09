<?php

use App\Models\Request;
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

Broadcast::channel('Campus.{req}', function ($user, $request_id) {
    $request = Request::find($request_id);
    return $user->id === $request->user_id
        || $user->id === $request->classOffer->teacher->user_id;
});
