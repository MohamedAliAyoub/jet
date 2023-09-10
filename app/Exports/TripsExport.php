<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TripsExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::query()->get()->map(function ($q){
            return [
                'id' => $q->id,
                'departure_country' => $q->departure_country ,
                'departure_city' , $q->departure_city,
                'departure_airport_name' , $q->departure_airport_name,
                'arrival_country' , $q->arrival_country,
                'arrival_city' , $q->arrival_city,
                'arrival_airport_name' , $q->arrival_airport_name,
                'date' , $q->date,
                'take_off_time' , $q->take_off_time,
                'landing_time' , $q->landing_time,
                'flight_status' , $q->flight_status,
                'created_at' => $q->created_at ,
                'updated_at' => $q->updated_at ,


            ];
        });

    }
    public function headings(): array
    {
        return [
            __('base.id'),
            __('base.name'),
            __('base.email'),
            __('base.created_at'),
            __('base.updated_at'),
        ];
    }
}
