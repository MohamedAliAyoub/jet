<?php

namespace App\Http\Requests\Trip;

use App\Enums\TripStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;


class CreateTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function onCreate(): array
    {
//        dd(request()->all());
        return [
//            "destination" => ['required', 'string'],
            "departure_country" => ['required', 'string', ],
            "departure_city" => ['required', 'string', ],
            "departure_airport_name" => ['required', 'string', ],
            "arrival_country" => ['required', 'string', ],
            "arrival_city" => ['required', 'string', ],
            "arrival_airport_name" => ['required', 'string', ],
            "date" => ['required', 'date', ],
            'take_off_time' => ['required', 'date'],
            "landing_time" => ['required', 'date' ,  'after:take_off_time' ],
            "flight_status" => ['required', new Enum(TripStatusEnum::class) ],
            "hours" => ['required', 'numeric' , "max:90" ],
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->whereNull('parent_id')
            ],

        ];
    }

    private function onUpdate(): array
    {
        return [
            "departure_country" => ['required', 'string', ],
            "departure_city" => ['required', 'string', ],
            "departure_airport_name" => ['required', 'string', ],
            "arrival_country" => ['required', 'string', ],
            "arrival_city" => ['required', 'string', ],
            "arrival_airport_name" => ['required', 'string', ],
            "date" => ['required', 'string' ],
            'take_off_time' => ['required'],
            "landing_time" => ['required' ,  'after:take_off_time' ],
            "flight_status" => ['required',  new Enum(TripStatusEnum::class) ],
            "hours" => ['required', 'numeric' , "max:90" ],
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->whereNull('parent_id')
            ],
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return request()->id ? $this->onUpdate() : $this->onCreate();
    }
}
