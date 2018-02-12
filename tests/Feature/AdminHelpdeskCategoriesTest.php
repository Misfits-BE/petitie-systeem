<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\Category;
use Tests\TestCase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;

/**
 * [HELPDESK]: Admin categories test case
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature
 */
class AdminHelpdeskCategoriesTest extends TestCase
{
    use RefreshDatabase, CreatesUsers, InputFakers;

    /**
     * @test
     * @testdox Test if an unauthenticated user doàesn't have access to the helpdesk admin section
     */
    public function indexUnauthenticated(): void
    {
        $this->get(route('admin.helpdesk.categories.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if an user with the correct role can view the helpdesk categories
     */
    public function indexWrongRole(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.helpdesk.categories.index'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test if an user with an incorrect doesn't have access to the helpdesk categories admin
     */
    public function indexCorrectRole(): void
    {
        factory(Category::class, 20)->create(['module' => 'helpdesk']);
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.helpdesk.categories.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if an authenticated user can't access the helpdesk categories create page.
     */
    public function createNoAuthentication(): void
    {
        $this->get(route('admin.helpdesk.categories.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if an user with incorrect role can't access the create page.
     */
    public function createIncorrectRole(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.helpdesk.categories.create'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test if the user with the correct role can view the create page without errors
     */
    public function createCorrectRole(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.helpdesk.categories.create'))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test that an unauthenticated user can't insert a helpdesk ticket
     */
    public function storeNoAuthenticated(): void
    {
        $this->post(route('admin.helpdesk.categories.store'), $this->fakeCategoryInput())
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Thest the error response when a user with incorrect role tries to insert some category.
     */
    public function storeIncorrectRole(): void 
    {
        //
    }

    /**
     * @test 
     * @testdox Test than a authenticated user can insert a new helpdesk category.
     */
    public function storeCorrectRole(): void 
    {
        //
    }

    /**
     * @test 
     * @testdox Test that the validation errors return from the controller
     */
    public function storeValidationErrors(): void
    {
        //
    }
}
