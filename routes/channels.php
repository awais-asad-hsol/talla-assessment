<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('private-chat.{userId}', function ($user, $userId) {
    logger("Broadcast auth check: user={$user->id}, channelUser={$userId}, roles=" . implode(',', $user->getRoleNames()->toArray()));

    // Admins can listen to any channel
    if ($user->hasAnyRole(['admin', 'super_admin'])) {
        return true;
    }

    // Employees can only listen to their own
    return (int) $user->id === (int) $userId;
});
