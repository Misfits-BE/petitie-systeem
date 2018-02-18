<?php

namespace Tests\Feature\Ban;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;

/**
 * Class: BanTest 
 * ---- 
 * Used for testing the banning system on the applicaton. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @category    Tests\Feature\Ban
 */
class BanTest extends TestCase
{
    use RefreshDatabase, CreatesUsers, InputFakers;

    /**
     * @test 
     * @testdox Test if an unauthenticated user can't ban a user. 
     */
    public function unauthenticated(): void
    {
        $user  = $this->createNormalUser();

        $this->post(route('admin.users.ban.create', $user), $this->fakeBanInput())
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test If a user with an incorrect role can't ban a user
     */
    public function incorrectRole(): void
    {
        $auth = $this->createNormalUser(); 
        $user = $this->createNormalUser();

        $this->actingAs($auth)
            ->post(route('admin.users.ban.create', $user), $this->fakeBanInput())
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Test the error response when an authenticated user tries to ban himself.
     */
    public function correctRoleUserIsauthenticatedUser(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.users.ban.create', $user), $this->fakeBanInput())
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message'   => 'Info: You cannot ban yourself in the application.', 
                $this->flashSession . '.level'     => 'info',
                $this->flashSession . '.important' => 'true',
            ])->assertRedirect(route('admin.users.index'));
    }

    /**
     * @test 
     * @testdox Test the error response when a user with incorrect user will be banned.
     */
    public function correctRoleWithInValidId(): void
    {
        $admin = $this->createAdminUser();

        $this->actingAs($admin)
            ->post(route('admin.users.ban.create', ['id' => 1000]), $this->fakeBanInput())
            ->assertStatus(404);
    }

    /**
     * @test 
     * @testdox Test the validation error response when no reason is given in the form
     */
    public function correctRoleValidIdWithValidationErrors(): void 
    {
        $user  = $this->createNormalUser();
        $admin = $this->createAdminUser();
        
        $this->actingAs($admin)
            ->post(route('admin.users.ban.create', $user), [])
            ->assertSessionHasErrors(['reason' => 'The reason field is required.'])
            ->assertSessionMissing([
                $this->flashSession . '.message'   => "{$user['name']} has been banned in the system.",
                $this->flashSession . '.level'     => 'success',
                $this->flashSession . '.important' => "true",
            ])->assertStatus(302);

    }

    /**
     * @test 
     * @testdox Test if a user with correct role ban another user
     */
    public function correctRoleWithValidId(): void
    {
        //
    }
}
