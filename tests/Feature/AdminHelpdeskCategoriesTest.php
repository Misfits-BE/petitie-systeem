<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\Category;
use Tests\TestCase;

/**
 * [HELPDESK]: Admin categories test case
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature
 */
class AdminHelpdeskCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test if an unauthenticated user doàesn't have access to the helpdesk admin section
     */
    public function indexUnauthenticated()
    {
        $this->get(route('admin.helpdesk.categories.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if an user with the correct role can view the helpdesk categories
     */
    public function indexWrongRole()
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
    public function indexCorrectRole()
    {
        factory(Category::class, 20)->create(['module' => 'helpdesk']);
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.helpdesk.categories.index'))
            ->assertStatus(200);
    }
}
