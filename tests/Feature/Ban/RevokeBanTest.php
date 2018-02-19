<?php

namespace Tests\Feature\Ban;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class: RevokeBanTest 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Ban
 */
class RevokeBanTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if an unauthenticated can't revok a user ban.
     */
    public function unauthenticated(): void
    {
        $this->get(route('admin.users.ban.revoke', $this->createNormalUser()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test if a user with the incorrect role can't revoke user bans.
     */
    public function incorrectRole(): void 
    {
        $login = $this->createNormalUser();

        $this->actingAs($login)
            ->get(route('admin.users.ban.revoke', $this->createNormalUser()))
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Test the error respose when revoking a user ban with wrong user identàifier
     */
    public function wrongId(): void 
    {
        $login = $this->createAdminUser();

        $this->actingAs($login)
            ->get(route('admin.users.ban.revoke', ['id' => 5000]))
            ->assertStatus(404);
    }

    /**
     * @test 
     * @testdox Test the flash session responsive when the authenticated user revoke the ban on himself
     */
    public function sameUser(): void 
    {
        $admin = $this->createAdminUser();

        $this->actingAs($admin)
            ->get(route('admin.users.ban.revoke', $admin))
            ->assertStatus(302)
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => 'Info: we could not revoke the ban in the application.',
                $this->flashSession . '.level'     => 'info',
                $this->flashSession . '.important' => true,
            ]);
    }

    /**
     * @test
     * @testdox Test the responjse when a user ban s successfully revoked.
     */
    public function success(): void
    {
        $this->markTestIncomplete('TODO: Implementation test.');
    }
}
