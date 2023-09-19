<?php

namespace App\Http\Resources\UserLogs;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,


            'title' => $this->title_text,
            'body' => $this->body_text,

        ];
    }
}
