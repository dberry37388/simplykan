<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;

/**
 * Class ResetsPasswordTest
 *
 * @package Tests\Feature
 * @group auth
 */
class ResetsPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Displays the reset password request form.
     *
     * @return void
     */
    public function testDisplaysPasswordResetRequestForm()
    {
        $this->get('password/reset')
            ->assertStatus(200);
    }
    /**
     * Sends the password reset email when the user exists.
     *
     * @return void
     */
    public function testSendsPasswordResetEmail()
    {
        $user = factory(User::class)->create();

        $this->expectsNotification($user, ResetPassword::class);

        $this->post('password/email', ['email' => $user->email])
            ->assertStatus(302);
    }
    /**
     * Does not send a password reset email when the user does not exist.
     *
     * @return void
     */
    public function testDoesNotSendPasswordResetEmail()
    {
        $this->doesntExpectJobs(ResetPassword::class);

        $this->post('password/email', ['email' => 'invalid@email.com']);
    }
    /**
     * Displays the form to reset a password.
     *
     * @return void
     */
    public function testDisplaysPasswordResetForm()
    {
        $this->get('/password/reset/token')
            ->assertStatus(200);
    }
    /**
     * Allows a user to reset their password.
     *
     * @return void
     */
    public function testChangesAUsersPassword()
    {
        $user = factory(User::class)->create();

        $token = Password::createToken($user);

        $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
