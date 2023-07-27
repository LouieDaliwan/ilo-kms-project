<?php

namespace Tests\Feature;

use App\Mail\WelcomeNewMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class MembersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_show_the_lists_of_members()
    {
        $this->get('/members')
            ->assertStatus(200);
    }

    /** @test */
    public function can_add_a_member()
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

    protected function postAddMembers($arr = []): TestResponse
    {
        return $this->post('/members', array_merge($arr, $this->userDetails()));
    }

    protected function userDetails(): array
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

    /** @test */
    public function a_newly_member_has_a_default_status_of_for_placement()
    {
        $this->postAddMembers();

        $user = User::first();

        $this->assertEquals('For Placement', actual: $user->status);
    }

    /** @test */
    public function a_newly_member_will_receive_email_notification()
    {
        Mail::fake();

        $this->postAddMembers();

        $user = User::first();

        Mail::assertSent(WelcomeNewMember::class, function (WelcomeNewMember $mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    /** @test */
    public function a_newly_member_will_generate_temporary_password()
    {
        Mail::fake();

        $this->postAddMembers();

        $user = User::first();

        $this->assertTrue($user->is_temporary_password);
        $this->assertNotEmpty($user->password);
    }

    /** @test */
    public function it_validates_the_fields_before_store_the_details()
    {
        $this->post('/members', [])
            ->assertSessionHasErrors([
                'first_name',
                'last_name',
                'email',
                'username',
            ]);
    }

    /** @test */
    public function can_update_the_details_of_members_or_users()
    {
        $user = User::factory()->create();

        $this->put("/members/{$user->id}", [
            'first_name' => 'John',
            'middle_name' => '',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'username' => 'johndoe',
            'gender' => 'Male',
            'metadata' => [
                'phone_number' => '09012345678',
                'age' => '21',
                'address' => 'Test Address',
                'source' => 'source',
                'social_media' => 'soc med',
            ],
        ]);

        $this->assertEquals('John', $user->fresh()->first_name);
        $this->assertEquals('Doe', $user->fresh()->last_name);
    }
}
