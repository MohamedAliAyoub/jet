<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::query()->firstOrCreate([
            'email' => User::SUPERADMIN_EMAIL ,
            'name' => 'Super Admin',
        ], [
            'name' => 'Super Admin',
            'password' => '123456',
        ]);

        // Admin
        $user = User::query()->firstOrCreate([
            'email' => 'mohamedali163163@gmail.com' ,
            'name' => 'Admin',

        ], [
            'name' => 'Admin',
            'password' => '123456',
        ]);

        // give superadmin all abilities...
        BouncerFacade::allow($superAdmin)->everything();
    }
}
