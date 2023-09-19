<?php

namespace Database\Seeders;

use App\Models\ConfigValues;

use Illuminate\Database\Seeder;
use function Ramsey\Uuid\v1;

class CofigValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigValues::query()->firstOrCreate( [
            'name' => 'terms',
        ], [
            'name' => 'terms',
            'value' => json_encode([
                'en' => 'Booking and Ticketing',
                'ar' => 'الحجز وإصدار التذاكر',
            ]),
        ]);

        ConfigValues::query()->firstOrCreate([
            'name' => 'conditions',
        ] ,[
            'name' => 'conditions',
            'value' => json_encode([
                'en' => 'Privacy and Data Protection:',
                'ar' => 'الخصوصية وحماية البيانات:',
            ]),
        ]);
    }
}
