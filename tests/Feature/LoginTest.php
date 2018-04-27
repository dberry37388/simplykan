<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class LoginTest
 *
 * @package Tests\Feature
 * @group auth
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The login form can be displayed.
     *
     * @return void
     */
    public function testLoginFormDisplayed()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function testLoginAValidUser()
    {
        $user = factory(User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function testDoesNotLoginAnInvalidUser()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ])->assertSessionHasErrors();

        $this->assertGuest();
    }

    /**
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function testLogoutAnAuthenticatedUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post('/logout')
            ->assertStatus(302);

        $this->assertGuest();
    }
}
