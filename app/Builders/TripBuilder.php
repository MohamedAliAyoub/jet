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

    public function searchDate()
    {
        return $this->when(request("search_date"), function ($query, $searchDate)  {
            return $query->where(function ($query) use ($searchDate) {
                $query->whereDate('date', request("search_date"));
            });
        });
    }


    public function traveller()
    {
        if (auth()->user()->roles()->first()?->name == 'traveller') {
            return $this->where('user_id', auth()->id());
        }

        if (auth()->user()->roles()->first()?->name == 'relative') {
            return $this->where('user_id', auth()->user()->parent_id);
        }

        return $this;
    }

}
