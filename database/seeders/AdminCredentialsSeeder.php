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
        User::create([
            'first_name' => 'Superadmin',
            'last_name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin',
            'password' => bcrypt('superadmin'),
        ]);
    }
}
