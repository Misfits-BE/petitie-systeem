<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class CreateViewTest
 *
 * @license     Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Users
 */
class CreateViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if an authenticated guest can't access the admin user create view.
     */
    public function unauthenticated(): void
    {
        $this->get(route('admin.users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the error response when a user with incorrect access try to access the user create page.
     */
    public function incorrectRole(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test is some correct user can access the user view without errors.
     */
    public function correctRole(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(200);
    }
}
