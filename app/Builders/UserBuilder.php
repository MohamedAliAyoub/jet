<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function search()
    {
        return $this->when(request("search"), function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($keyword) . '%']);
            });
        });

    }

    public function relative()
    {

        if (auth()->user()->roles()->first()?->name == 'traveller') {
            return $this->where('parent_id', auth()->user()->id);
        }

        return $this;

    }
}
