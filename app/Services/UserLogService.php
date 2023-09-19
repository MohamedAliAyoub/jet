<?php

namespace App\Services;

use App\Models\UserLog;

class UserLogService
{
    public function createLog($title, $body, $userId): void
    {
        UserLog::query()->create([
            'title' => $title,
            'body' => $body,
            'user_id' => $userId,
        ]);
    }
}
