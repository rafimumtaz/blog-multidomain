<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chatroom', function ($user) {
    // Pastikan hanya user yang terotentikasi yang bisa masuk
    if ($user) {
        // Data ini akan dikirim ke user lain yang ada di channel
        return [
            'id' => $user->id,
            'name' => $user->name,
            'institution' => $user->institution->name
        ];
    }
});