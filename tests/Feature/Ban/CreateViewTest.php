<?php

namespace Tests\Feature\Ban;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\User;
use Tests\Traits\CreatesUsers;

/**
 * Class: CreateViewTest 
 * ---
 * Test the functionality for the user ban create view. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Test\Feature\Ban
 */
class CreateViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test if an unauthenticated quest can access the user ban create view.
     */
    public function unauthenticated(): void
    {
        $this->get(route('admin.users.ban', $this->createNormalUser()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if an unauthenticated user can't access the user ban create view.
     */
    public function incorrectRole(): void 
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.users.ban', $this->createNormalUser()))
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Test the error response from the view when an invalid id is given.()
     */
    public function correctRoleInvalidId(): void 
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.users.ban', ['id' => 1000000]))
            ->assertStatus(404);
    }

    /**
     * @test 
     * @testdox Test if a correct authenticated user can successfully view the ban create view.
     */
    public function correctRoleValidId(): void 
    {
        $user = $this->createAdminUser(); 

        $this->actingAs($user)
            ->get(route('admin.users.ban', $this->createNormalUser()))
            ->assertStatus(200);
    }
}
