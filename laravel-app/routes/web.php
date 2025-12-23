<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Notifications\WhatsappMessageNotification;
use Illuminate\Support\Facades\Log;

Route::get('/message', function () {
    try {
        $user = User::find(1);
        $user->notify(new WhatsappMessageNotification());
        return "Message sent successfully";
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return "Message failed to send";
    }
});
