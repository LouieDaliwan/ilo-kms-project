<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_a_full_name_attribute()
    {
        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertEquals('John Doe', $user->fullname);
    }

    /** @test */
    function it_has_a_method_save_remarks_and_the_args_the_author_id_and_remarks()
    {
        $this->assertTrue(method_exists(User::class, 'saveRemarks'));

        User::factory()->count(2)->create();

        $author = User::first();

        $member = User::skip(1)->first();

        $this->assertNotNull($member->saveRemarks($author, 'Test Remarks'));
    }

    /** @test */
    function it_should_save_the_remarks_of_author_into_member()
    {
        User::factory()->count(2)->create();

        $author = User::first();

        $member = User::skip(1)->first();

        $member->saveRemarks($author, 'Test Remarks');

        $this->assertCount(1, $member->fresh()->remarks);

    }
}
