<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class RoleBuilder extends Builder
{
    public function search()
    {
        return $this->when(request("search"), function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                    ->orWhereRaw('LOWER(title) LIKE ?', ['%' . strtolower($keyword) . '%']);
            });
        });
    }
}
