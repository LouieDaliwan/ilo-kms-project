<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 10000;

        for ($i = 0; $i >= $count; $i++) {
            User::firstOrCreate([
                'firstname' => ,
                'middlename' => ,
                'lastname' => ,
                'email' => ,

            ]);
        }

    }
}
