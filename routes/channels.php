<?php
use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('chatroom', function ($user) {
    if ($user) {
        return ['id' => $user->id, 'name' => $user->name, 'institution' => $user->institution->name];
    }
});