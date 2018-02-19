<?php

namespace Tests\Feature\Users;

use Misfits\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;

/**
 * Class IndexTest
 * ---
 * Class for testing the user admin console.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Users
 */
class IndexTest extends TestCase
{
    use RefreshDatabase, InputFakers, CreatesUsers;

    /**
     * @test
     * @testdox Test the error response when an unauthenticated user tries to access the user management index
     */
    public function unauthenticated(): void
    {
        $this->get(route('admin.users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the error response when a user with incorrect role tries to access the user management index
     */
    public function incorrectRole(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test if an admin can view the user manegeent view witout errors
     */
    public function correctRole(): void
    {
        factory(User::class, 40)->create();

        $admin = $this->createAdminUser();

        $this->actingAs($admin)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }
}
