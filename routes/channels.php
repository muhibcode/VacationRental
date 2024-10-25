<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('user.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel(
//     'booking-notify',
//     function () {
//         return true;
//     }
// );