<?php

namespace Database\Factories;

use App\Enums\ClientTypeEnum;
use App\Models\BloodType;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ar' => $this->faker->name(),
                'en' => $this->faker->name(),
            ],
            'email' => $this->faker->safeEmail(),
            'password' => '123456',
            'mobile' => '0501234567',
            'type' => $this->faker->randomElement(
                array_column(ClientTypeEnum::cases(), 'value')
            ),
            'area_id' => City::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
            'blood_type_id' => BloodType::factory()->create()->id,
        ];
    }
}
