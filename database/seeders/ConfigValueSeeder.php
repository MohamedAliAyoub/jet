<?php

namespace Database\Seeders;

use App\Models\ConfigValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigValues::query()->firstOrCreate( [
            'name' => 'terms',
            'value' => json_encode([
                'en' => 'Booking and Ticketing',
                'ar' => 'الحجز وإصدار التذاكر',
            ]),
        ]);

        ConfigValues::query()->firstOrCreate([
            'name' => 'conditions',
            'value' => json_encode([
                'en' => 'Privacy and Data Protection:',
                'ar' => 'الخصوصية وحماية البيانات:',
            ]),
        ]);
    }
}
