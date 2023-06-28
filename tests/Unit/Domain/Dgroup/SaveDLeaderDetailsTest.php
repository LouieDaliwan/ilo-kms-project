<?php

namespace Tests\Unit\Domain\Dgroup;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Domain\Dgroup\Actions\SaveDLeaderDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaveDLeaderDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_saves_the_details_for_new_leader()
    {
        $saveDLeader = new SaveDLeaderDetails();

        $user = User::factory()->create();

        $data = ($saveDLeader)($user,[
            'day' => 'Wed',
            'start_date' => Carbon::now()->format('Y-m-d'),
            'life_stage_type' => 'Singles',
            'start_time' => Carbon::parse('08:00 pm')->format('H:i:s'),
            'end_time' => Carbon::parse('09:00 pm')->format('H:i:s'),
        ]);

        $this->assertDatabaseHas('dgroups', [
            'leader_id' => $user->id,
            'life_stage_type' => 'Singles',
            'status' => 'Active',
            'accept_new_member' => 1,
        ]);

        $this->assertTrue($data instanceof User);
    }
}
