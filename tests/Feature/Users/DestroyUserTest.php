<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class DestroyUserTest
 * ---
 * Testsuite for testing that in the admin console a user can be deleted.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Users
 */
class DestroyUserTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if an unauthenticated user can't delete another user
     */
    public function unauthenticated(): void
    {
        $user = $this->createNormalUser();

        $this->get(route('admin.users.delete', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a user with some incorrect role can't delete a user.
     */
    public function incorrectRole(): void
    {
        $login = $this->createNormalUser();
        $user  = $this->createNormalUser();

        $this->actingAs($login)
            ->get(route('admin.users.delete', $user))
            ->assertStatus(302);
    }

    /**
     * @test
     * @testdox Test the error response whuen we try delete with an invalid resource id
     */
    public function correctRoleInvalidId(): void
    {
        $admin = $this->createAdminUser();

        $this->actingAs($admin)
            ->get(route('admin.users.delete', ['id' => 100000]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox T6est if we can successful delete a user in the database storage
     */
    public function correctRoleValidId(): void
    {
        $admin = $this->createAdminUser();
        $user  = $this->createNormalUser();

        $this->assertDatabaseHas('users' , ['id' => $user->id]);

        $this->actingAs($admin)
            ->get(route('admin.users.delete', $user))
            ->assertStatus(302)
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => $user->name . ' is deleted in the application.',
                $this->flashSession . '.level'     => 'success',
                $this->flashSession . '.important' => true,
            ]);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseHas('activity_log', [
            'log_name' => 'default', 'description' => "Has removed {$user->name} in the application",
            'subject_id' => $user->id, 'subject_type' => 'Misfits\User', 'causer_id' => $admin->id,
            'causer_type' => "Misfits\User", 'properties' => '[]'
        ]);
    }
}
