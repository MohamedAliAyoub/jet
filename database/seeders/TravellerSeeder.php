<?php

namespace Database\Seeders;

use App\Enums\Abilities;
use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;

class TravellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get an instance of Bouncer
        $bouncer = app(Bouncer::class);

        // Create or retrieve the "admin" role
        $bouncer->role()->firstOrCreate([
            'name' => 'traveller',
            'title' => 'المسافرين',
        ]);


        // Give the "admin" role all permissions
        $bouncer->allow('traveller')->to([
            Abilities::MODULE_TRIP_INDEX->value,
            Abilities::MODULE_ADMINS_INDEX->value
        ]);
    }
}
