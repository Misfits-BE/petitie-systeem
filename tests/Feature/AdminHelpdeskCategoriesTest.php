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
        $user = $this->createNormalUser(); 

        $this->actingAs($user)
            ->post(route('admin.helpdesk.categories.store'), $this->fakeCategoryInput())
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Test than a authenticated user can insert a new helpdesk category.
     */
    public function storeCorrectRole(): void 
    {
        $user         = $this->createAdminUser();
        $input        = $this->fakeCategoryInput(); 
        $methodFields = ['author_id' => $user->id, 'slug' => 'category', 'module' => 'helpdesk'];

        $this->actingAs($user)
            ->post(route('admin.helpdesk.categories.store'), $input)
            ->assertSessionHas([
                $this->flashSession . '.message' => $input['name'] . ' has been added as helpdesk category.', 
                $this->flashSession . '.level'   => 'success'
            ])
            ->assertStatus(302)
            ->assertRedirect(route('admin.helpdesk.categories.index'));

        $this->assertDatabaseHas('activity_log', [
            'log_name' => 'default', 'description' => "has created the category {$input['name']}", 'subject_type' => 'Misfits\Category', 'causer_id' => $user->id, 'properties' => '[]'
        ]);

        $this->assertDatabaseHas('categories', array_merge($methodFields, $input));
    }

    /**
     * @test 
     * @testdox Test that the validation errors return from the controller
     */
    public function storeValidationErrors(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.helpdesk.categories.store'), [])
            ->assertSessionHasErrors()
            ->assertSessionHasErrors([
                'name' => 'The name field is required.', 
                'color' => 'The color field is required.', 
                'description' => 'The description field is required.',
            ])->assertSessionMissing([
                $this->flashSession . '.message' => 'Category has been added as helpdesk category.', 
                $this->flashSession . '.level'   => 'success']
            )
            ->assertStatus(302);
    }

    /**
     * @test 
     * @testdox Category edit unauthenticated
     */
    public function categoryEditUnauthenticated(): void 
    {
        $this->get(route('admin.helpdesk.categories.edit', factory(Category::class)->create()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Category edit incorrect role
     */
    public function categoryEditIncorrectRole(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.edit', factory(Category::class)->create()))
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Category edit correct role and valid ID
     */
    public function categoryEditCorrectRoleValidId(): void
    {
        $user     = $this->createAdminUser();
        $category = factory(Category::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.edit', $category))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Category edit correct role but invalid id
     */
    public function categoryEditCorrectRoleInvalidId(): void 
    {
        $user = $this->createAdminUser(); 

        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.edit', ['id' => 1000]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Category update unauthenticated
     */
    public function categoryUpdateUnauthenticated(): void 
    {
        $input    = $this->fakeCategoryInput();
        $category = factory(Category::class)->create();

        $this->patch(route('admin.helpdesk.categories.update', $category), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Category update incorrect role
     */
    public function categoryUpdateIncorrectRole(): void 
    {
        $user     = $this->createNormalUser();
        $input    = $this->fakeCategoryInput();
        $category = factory(Category::class)->create(); 

        $this->actingAs($user)
            ->patch(route('admin.helpdesk.categories.update', $category), $input)
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Category update correct role invalid id
     */
    public function categoryUpdateCorrectRoleInvalidId(): void
    {
        $user     = $this->createAdminUser();
        $input    = $this->fakeCategoryInput();

        $this->actingAs($user)
            ->patch(route('admin.helpdesk.categories.update', ['id' => 1000]), $input)
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Category update incorect Role valid id
     */
    public function categoryUpdateIncorrectRoleValidId(): void 
    {
        $user     = $this->createAdminUser(); 
        $input    = $this->fakeCategoryInput();
        $category = factory(Category::class)->create();

        $this->actingAs($user)
            ->patch(route('admin.helpdesk.categories.update', $category), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.helpdesk.categories.edit', $category))
            ->assertSessionMissing([
                $this->flashSession . '.message' => 'Category has been added as helpdesk category.', 
                $this->flashSession . '.level'   => 'success']
            );

        $this->assertDatabaseHas('categories', array_merge(['id' => $category->id], $input));

        $this->assertDatabaseHas('activity_log', [
            'log_name' => 'default', 'description' => "Has updated the category {$input['name']}", 
            'subject_id' => $category->id, 'subject_type' => 'Misfits\Category', 'causer_id' => $user->id, 'properties' => '[]'
        ]);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id, 'name' => $category->name, 'color' => $category->color, 'description' => $category->description
        ]);
    }

    /**
     * @test
     * @testdox Category updat with coreect role and id but with incomple data
     */
    public function categoryUpdateCorrectRoleValidationErrors(): void 
    {
        $user     = $this->createAdminUser(); 
        $category = factory(Category::class)->create(); 

        $this->actingAs($user)
            ->patch(route('admin.helpdesk.categories.update', $category), [])
            ->assertStatus(302)
            ->assertSessionMissing([
                $this->flashSession . '.message' => 'The category has been updated.', 
                $this->flashSession . '.level'   => 'success']
            )->assertSessionHasErrors([
                'name' => 'The name field is required.', 
                'color' => 'The color field is required.', 
                'description' => 'The description field is required.',
            ]);

        $this->assertDatabaseMissing('activity_log', [
            'log_name' => 'default', 'subject_id' => $category->id, 
            'subject_type' => 'Misfits\Category', 'causer_id' => $user->id, 'properties' => '[]',
            'description' => "Has updated the category {$category->name}", 
        ]);
    }

    /**
     * @test
     * @testdox Delete category Unauthenticated
     */
    public function deleteCategoryUnauthenticated(): void 
    {
        $category = factory(Category::class)->create(); 

        $this->get(route('admin.helpdesk.categories.delete', $category))
            ->assertStatus(302)
            ->assertRedirect(route('login')); 
    }

    /**
     * @test
     * @testdox delete category Incorrect role
     */
    public function deleteCategoryIncorrectRole(): void 
    {
        $user     = $this->createNormalUser();
        $category = factory(Category::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.delete', $category))
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Delete category correct role and valid id
     */
    public function deleteCategoryCorrectRoleValidId(): void 
    {
        $user     = $this->createAdminUser();
        $category = factory(Category::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.delete', $category))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => $category->name . ' has been deleted as helpdesk category.', 
                $this->flashSession . '.level'   => 'success'
            ]);

            $this->assertDatabaseMissing('categories', ['id' => $category->id]);

            $this->assertDatabaseHas('activity_log', [
                'log_name' => 'default',  'description' => " has deleted the category {$category->name}", 'subject_id' => $category->id, 
                'subject_type' => 'Misfits\Category', 'causer_id' => $user->id, 
                'properties' => '[]'
            ]);
    }

    /**
     * @test 
     * @testdox
     */
    public function deleteCategoryCorrectRoleInvalidId(): void 
    {
        $user     = $this->createAdminUser();
    
        $this->actingAs($user)
            ->get(route('admin.helpdesk.categories.delete', ['id' => 1000]))
            ->assertStatus(404);
    }
}
