<?php

namespace Database\Seeders;

use App\Constants\UserTypes;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => env("SUPER_ADMIN_EMAIL"),
            'password' => env("SUPER_ADMIN_PASSWORD"),
            'type' => UserTypes::SUPER_ADMIN,
            'phone' => env("SUPER_ADMIN_PHONE"),
            'active' => true
        ]);
    }
}
