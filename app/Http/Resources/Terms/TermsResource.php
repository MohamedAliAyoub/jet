<?php

namespace App\Http\Resources\Terms;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => __('base.terms_conditions'),
            'value' => $this->value_text,
        ];
    }
}
