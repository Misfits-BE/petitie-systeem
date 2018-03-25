<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 *  Class PasswordUpdateTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten ans his contributors
 * @package     Misfits\Feature\UserSettings
 */
class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test is a authenticated user can update his password
     *
     * @group account-settings
     */
    public function success(): void
    {
        $input = ['password' => 'OpenSource123456!', 'password_confirmation' => 'OpenSource123456!'];
        $user  = $this->createNormalUser();

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('account.settings', ['type' => 'security']))
            ->assertSessionHas([
                $this->flashSession . '.message'    => 'Your profile password has been updated.',
                $this->flashSession . '.level'      => 'success',
                $this->flashSession . '.important'  => true
            ]);
    }

    /**
     * @test
     * @testdox Test if a quest user can't update an account password.
     *
     * @group account-settings
     */
    public function unAuthenticated(): void
    {
        $input = ['password' => 'OpenSource15335!', 'password_confirmation' => 'OpenSource15335!'];

        $this->patch(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a blocked user can't update his account password
     *
     * @group account-settings
     */
    public function blockedUser(): void
    {
        $input = ['password' => 'OpenSource123456!', 'password_confirmation' => 'OpenSource123456!'];
        $user  = $this->createBlockedUser();

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test the password required validation
     *
     * @group account-settings
     */
    public function validationPasswordRequired(): void
    {
        $user  = $this->createNormalUser();
        $input = ['password_confirmation' => 'OpenSource12345!'];

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertSessionHasErrors([
                'password' => trans('validation.required', ['attribute' => 'password'])
            ]);
    }

    /**
     * @test
     * @testdox Test the HIBP implementation on the validation
     *
     * @group account-settings
     */
    public function validationPasswordPwned(): void
    {
        $input = ['password' => 'admin1234', 'password_confirmation' => 'admin1234'];
        $user  = $this->createNormalUser();

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertSessionHasErrors(['password' => trans('validation.pwned')]);
    }

    /**
     * @test
     * @testdox Test the password needs to be string rule.
     *
     * @group account-settings
     */
    public function validationPasswordString(): void
    {
        $pass  = 12345579998876557565346;
        $user  = $this->createNormalUser();
        $input = ['password' => $pass, 'password_confirmation' => $pass];

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertSessionHasErrors([
                'password' => trans('validation.string', ['attribute' => 'password'])
            ]);
    }

    /**
     * @test
     * @testdox Test the password confirmation validation rule
     *
     * @group account-settings
     */
    public function validationPasswordConfirmed(): void
    {
        $user  = $this->createNormalUser();
        $input = ['password' => 'OpenSource1234!', 'password_confirmation' => 'OpenSourceEEEE'];

        $this->actingAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertSessionHasErrors([
                'password' => trans('validation.confirmed', ['attribute' => 'password'])
            ]);
    }
}
