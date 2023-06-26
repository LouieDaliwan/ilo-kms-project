<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignDgroupLeaderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function __setup() :void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    protected function firstUser()
    {
        return User::factory()->create();
    }

    /** @test */
    function a_user_can_assign_a_dgroup_leader_for_a_new_member()
    {
        $this->markTestIncomplete();
        //create a user

        //call the dgroup leader user

        //assert that a created user was a member of dgroup leader and it shows the name of his/her leader

    }

}
