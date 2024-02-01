<?php

namespace Domain\Users\Actions;

use App\Models\User;
use Exception;

class UserCreateActions
{
    public function __invoke($attributes)
    {
       $attributes['details']['Mobile Phone']['value'] = $attributes['mobile_number'] ?? null;
       $attributes['details']['Home Address']['value'] = $attributes['home_address'] ?? null;

        try {
            $user = User::firstOrCreate([
                'first_name' => $attributes['firstname'],
                'middle_name' => $attributes['middlename'],
                'last_name' => $attributes['lastname'],
                'email' => $attributes['email'],
                'username' => $attributes['username'],
                'prefixname' => $attributes['prefixname'] ?? '',
                'suffixname' => $attributes['suffixname'] ?? '',
                'gender' => $attributes['details']['Gender']['value'] ?? null,
                'photo' => $attributes['photo'] ?? null,
                'metadata' => $attributes['details'],
                'password' => $attributes['password'],
            ]);


            $user->assignRole($attributes['roles']);

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
