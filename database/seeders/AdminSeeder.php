<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;

class AdminSeeder extends Seeder
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
            'name' => 'admin',
        ]);


        // Give the "admin" role all permissions
        $bouncer->allow('admin')->everything();
    }
}
