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
    function a_authorized_can_assign_a_dgroup_leader_and_also_create_new_dgroup()
    {
        $this->userAssignRole('Superadmin');

        $member = $this->member();

        $this->put("members/{$member->id}/assign-dgroup-leader");


        $this->assertTrue($member->fresh()->hasRole('DGroup-Leader'));
        $this->assertEquals(1, $member->fresh()->dgroup->count());
    }

    /** @test */
    function a_authorized_user_can_only_access_to_promote_a_member()
    {
        $this->markTestIncomplete();

        $this->userAssignRole('Member');

        $member = $this->member();

        $this->put("members/{$member->id}/assign-dgroup-leader")
        ->assertUnauthorized();
    }
}
