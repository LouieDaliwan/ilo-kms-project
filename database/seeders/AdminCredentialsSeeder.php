<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminCredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
                'email' => 'superadmin@superadmin.com',
            ],
            [
                'first_name' => 'Superadmin',
                'last_name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@superadmin.com',
                'password' => bcrypt('superadmin'),
                'is_temporary_password' => 0,
            ]
        );

        $user->assignRole('Superadmin');
    }
}
