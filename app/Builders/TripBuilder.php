<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class TripBuilder extends Builder
{
    public function search()
    {
        return $this->when(request("search"), function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->whereRaw('LOWER(destination) LIKE ?', ['%' . strtolower($keyword) . '%'])
                    ->orWhereRaw('LOWER(departure_country) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(departure_city) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(departure_airport_name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(arrival_country) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(arrival_city) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(arrival_airport_name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            });
        });

    }
}
