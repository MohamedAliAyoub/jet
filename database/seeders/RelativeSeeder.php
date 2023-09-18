<?php

namespace Database\Seeders;

use App\Enums\Abilities;
use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;



class RelativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get an instance of Bouncer
        $bouncer = app(Bouncer::class);

        // Create or retrieve the "traveller" role
        $role = $bouncer->role()->firstOrCreate([
            'name' => 'relative',
            'title' => 'الاقارب',
        ]);

        // Give the "traveller" role specific permissions
        $bouncer->allow($role)->to([
            Abilities::MODULE_TRIP_INDEX->value,
            Abilities::MODULE_ADMINS_INDEX->value,
        ]);
    }
}
