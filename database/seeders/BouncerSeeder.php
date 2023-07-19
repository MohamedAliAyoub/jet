<?php

namespace Database\Seeders;

use App\Enums\Abilities;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;
use Silber\Bouncer\BouncerFacade;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::query()->firstOrCreate(['email' => User::SUPERADMIN_EMAIL], [
            'name' => 'super_admin',
            'mobile' => '01123456',
            'password' => '123456',
        ]);

        // Admin
        $user = User::query()->firstOrCreate(['email' => 'mohamedali163163@gmail.com'], [
            'name' => 'mohamed_ali',
            'mobile' => '01123456',
            'password' => '123456',
        ]);

        // give superadmin all abilities...
        BouncerFacade::allow($superAdmin)->everything();
    }
}
