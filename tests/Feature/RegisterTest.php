<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RegisterTest
 *
 * @package Tests\Feature
 * @group auth
 */
class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * The registration form can be displayed.
     *
     * @return void
     */
    public function testRegisterFormDisplayed()
    {
        $this->get('/register')
            ->assertStatus(200);
    }

    /**
     * A valid user can be registered.
     *
     * @return void
     */
    public function testRegistersAValidUser()
    {
        $user = factory(User::class)->make();

        $this->post('register', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertStatus(302);

        $this->assertAuthenticated();
    }

    /**
     * An invalid user is not registered.
     *
     * @return void
     */
    public function testDoesNotRegisterAnInvalidUser()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->make();

        $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid'
        ])->assertSessionHasErrors();

        $this->assertGuest();
    }
}
