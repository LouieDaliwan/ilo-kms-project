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

    protected function setUp() : void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    protected function member() : User
    {
        $user = User::factory()->create();

        $user->assignRole('Member');

        return $user;
    }


    protected function dleader() : User
    {
        $user = User::factory()->create();

        $user->assignRole('DGroup-Leader');

        return $user;
    }

    /** @test */
    function a_dgroup_leader_can_endorse_a_member_to_be_a_dgroup_leader()
    {
        $this->markTestIncomplete();

        $leader = $this->userAssignRole('DGroup-Leader');

        $member = $this->member();

        $this->put("/members/{$member->id}/endorse-to-be-leader");

        $this->assertDatabaseHas('endorse_to_be_leaders', [
            'endorse_by_id' => $leader->id,
            'user_id' => $member->id,
            'status' => 'Pending',
            'approved_by' => null
        ]);
    }

    /** @test */
    function a_authorized_can_assign_a_dgroup_leader()
    {
        $this->userAssignRole('Superadmin');

        //create a member with no dgroup leader
        $member = $this->member();

        //asssign the member to be a dgroup leader role
        $this->put("members/{$member->id}/assign-dgroup-leader");

        //assert that a created user was a member of dgroup leader and it shows the name of his/her leader
        $this->assertTrue($member->fresh()->hasRole('DGroup-Leader'));
    }
}
