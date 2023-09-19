<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SuperAdminSeeder::class);
        $this->call(BouncerSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RelativeSeeder::class);
        $this->call(TravellerSeeder::class);
        $this->call(CofigValuesSeeder::class);
    }
}
