<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class InfoUpdateTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\UserSettings
 */
class InfoUpdateTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if a unauthenticated user can't change user account information.
     *
     * @group account-settings
     */
    public function unauthenticated(): void
    {
        $input = ['name' => 'Jhon Doe', 'email' => 'john.doe@gmail.com'];

        $this->patch(route('account.settings.info'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a authenticated user can change his account information.
     *
     * @group account-settings
     */
    public function authenticated(): void
    {
        $user  = $this->createNormalUser();
        $check = ['name', $user->name, 'email' => $user->email];
        $input = ['name' => 'Jhon Doe', 'email' => 'john.doe@gmail.com'];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('account.settings', ['type' => 'informatie']))
            ->assertSessionHas([
                $this->flashSession . '.message'    => 'Your profile information has been updated.',
                $this->flashSession . '.level'      => 'success',
                $this->flashSession . '.important'  => true
            ]);

        $this->assertDatabaseMissing('users', $check);
        $this->assertDatabaseHas('users', $input);
    }

    /**
     * @test
     * @testdox Test if a blocked user can't change his account information
     *
     * @group account-settings
     */
    public function blockedUsers(): void
    {
        $user  = $this->createBlockedUser();
        $input = ['name' => 'Jhon Doe', 'email' => 'john.doe@gmail.com'];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test if a account name is required in the method.
     */
    public function validationNameRequired(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->patch(route('account.settings.info'), ['email' => 'John.doe@example.tld'])
            ->assertSessionHasErrors([
                'name' => trans('validation.required', ['attribute' => 'name'])
            ]);
    }

    /**
     * @test
     * @testdox Test is the name field for the account needs to be a string
     *
     * @group account-settings
     */
    public function validationNameString(): void
    {
        $input = ['name' => rand(0, 250), 'email' => 'John.doe@example.tld'];
        $user  = $this->createNormalUser();

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors([
                'name' => trans('validation.string', ['attribute' => 'name'])
            ]);
    }

    /**
     * @test
     * @testdox Test the max length for the account name field.
     *
     * @group account-settings
     */
    public function validationNameMax(): void
    {
        $user  = $this->createNormalUser();
        $input = ['name' => str_random(276), 'email' => 'john.doe@example.tld'];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors([
                'name' => trans('validation.max.string', ['attribute' => 'name', 'max' => 255])
            ]);
    }

    /**
     * @test
     * @testdox  Test the required validation rule for the email field.
     *
     * @group account-settings
     */
    public function validationEmailRequired(): void
    {
        $user  = $this->createNormalUser();
        $input = ['name' => 'John Doe'];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.required', ['attribute' => 'email'])]);
    }

    /**
     * @test
     * @testdox Test the string validation rule for the user email
     *
     * @group account-settings
     */
    public function validationEmailString(): void
    {
        $user  = $this->createNormalUser();
        $input = ['name' => 'John Doe', 'email' => rand(0, 260)];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.string', ['attribute' => 'email'])]);
    }

    /**
     * @test
     * @testdox Test the validation for checking of the given email field is effective an email address
     *
     * @group account-settings
     */
    public function validationEmailEmail(): void
    {
        $input = ['name' => 'John Doe', 'email' => 'fake email address'];
        $user  = $this->createNormalUser();

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.email', ['attribute' => 'email'])]);
    }

    /**
     * @test
     * @testdox Test the max length validation rule for the email field
     *
     * @group account-settings
     */
    public function validationEmailMax(): void
    {
        $user  = $this->createNormalUser();
        $input = ['name' => 'John Doe', 'email' => str_random(250) . '@example.org'];

        $this->actingAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertSessionHasErrors([
                'email' => trans('validation.max.string' , ['attribute' => 'email', 'max' => 255])
            ]);
    }
}
