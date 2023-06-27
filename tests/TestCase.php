<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function signUp($user = null) : User
    {

        $user = $user ?? User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    public function userAssignRole($role = null, $user = null) : User
    {
        $user = $this->signUp($user);

        $user->assignRole($role ?? 'Member');

        return $user;
    }
}
