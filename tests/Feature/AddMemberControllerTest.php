<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddMemberControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function userDetails()
    {
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'username' => 'johndoe',
            'gender' => 'Male',
            'metadata' => [
                'phone' => '09012345678',
                'age' => '21',
            ],
        ];
    }

    protected function postAddMembers($arr = [])
    {
        return $this->post('/add-members', array_merge($arr, $this->userDetails()));
    }

    /** @test */
    function can_add_a_member()
    {
        //post the details to the route
        $this->postAddMembers();

        //assert the member is added to the database
        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
        ]);
    }

    /** @test */
    function a_newly_member_has_a_default_status_of_for_placement()
    {
        $this->postAddMembers();

        $user = User::first();

        $this->assertEquals('For Placement', $user->status);
    }
}
