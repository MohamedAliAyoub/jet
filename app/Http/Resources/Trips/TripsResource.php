<?php

namespace App\Http\Resources\Trips;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripsResource extends JsonResource
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
            'your_hours' => auth()->user()->hours_balance,
            'your_flights' =>  auth()->user()->hours_number,

            'departure_country' => $this->departure_country,
            'departure_city' => $this->departure_city,
            'departure_airport_name' => $this->departure_airport_name,
            'arrival_country' => $this->arrival_country,
            'arrival_city' => $this->arrival_city,
            'arrival_airport_name' => $this->arrival_airport_name,
            'date' => $this->date,
            'take_off_time' => $this->take_off_time,
            'landing_time' => $this->landing_time,
            'flight_status' => $this->flight_status,
            'hours' => $this->hours,

        ];
    }
}
