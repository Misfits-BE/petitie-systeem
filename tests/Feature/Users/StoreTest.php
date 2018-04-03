<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Spatie\Permission\Models\Role;

/**
 * Class StoreTest
 * ---- 
 * PHPUnit testcase for creating users in the backend console. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Users
 */
class StoreTest extends TestCase
{
    use RefreshDatabase, CreatesUsers, WithFaker;

    /**
     * @test
     * @testdox Test if an authencated user can create a new user in the system. 
     * 
     * @group users
     */
    public function authenticated(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(); 
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'name' => 'John doe', 'email' => 'john.doe@example.org', 'role' => $role->name]; 

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => "Has created a login for " .  $input['name'] . " in the application.",
                $this->flashSession . '.level'     => 'success', 
                $this->flashSession . '.important' => true
            ]);
    }

    /**
     * @test
     * @testdox Test if an unauthenticated will be redirect to login page. 
     * 
     * @group users
     */
    public function unauthenticated(): void 
    {
        $role  = factory(Role::class)->create(); 
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'jhon.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];
    
        $this->post(route('admin.users.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test if only users with the admin role can create a new user. 
     * 
     * @group users
     */
    public function adminRole(): void 
    {
        $user = $this->createNormalUser(); 
        $role  = factory(Role::class)->create();
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'jhon.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test if a blocked user can't access the user store method
     * 
     * @group users
     */
    public function blockedUser(): void 
    {
        $user  = $this->createBlockedUser();
        $role  = factory(Role::class)->create();
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'jhon.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];
    
        $this->actingAs($user)
            ->post(route('admin.users.store', $input))
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test the name required validation rule
     * 
     * @group users
     */
    public function validationNameRequired(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(); 
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'john.doe@example.org', 'role' => $role->name]; 

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionhasErrors(['name' => trans('validation.required', ['attribute' => 'name'])]);
    }

    /**
     * @test
     * @testdox Test the name string validation
     * 
     * @group users
     */
    public function validationNameString(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(); 
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'name' => rand(0, 25), 'email' => 'john.doe@example.org', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionhasErrors(['name' => trans('validation.string', ['attribute' => 'name'])]);
    }

    /**
     * @test
     * @testdox Test the name max 255 characters validation
     * 
     * @group users
     */
    public function validationNameMax255(): void 
    {
        $user  = $this->createAdminUser();
        $role  = factory(Role::class)->create();
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'John.doe@example.org', 'name' => str_random(270), 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['name' => trans('validation.max.string', [
                'attribute' => 'name', 'max' => 255
            ])]);
    }

    /**
     * @test
     * @testdox Test the email required validation rule
     * 
     * @group users
     */
    public function validationEmailRequired(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create();
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'name' => rand(0, 250), 'role' => $role->name]; 

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.required', ['attribute' => 'email'])]);
    }

    /**
     * @test
     * @testdox Test the email max 255 characters validation
     * 
     * @group users
     */
    public function validationEmailMax255(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(['name' => 'admin']); 
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => str_random(250) . '@example.tld', 'name' => 'John doe', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors([
                'email' => trans('validation.email', ['attribute' => 'email']),
                'email' => trans('validation.max.string', [
                    'max' => 255, 'attribute' => 'email',
                ])
            ]);
    }

    /**
     * @test
     * @testdox Test the firstname required validation rule 
     * 
     * @group users
     */
    public function validationFirstnameRequired(): void
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create();
        $input = ['lastname' => 'Doe', 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['firstname' => trans('validation.required', ['attribute' => 'firstname'])]);
    }

    /**
     * @test
     * @testdox Test the firstname string validation rule
     * 
     * @group users
     */
    public function validationFirstnameString(): void 
    {
        $user   = $this->createAdminUser();
        $role   = factory(Role::class)->create(['name' => 'admin']);
        $input  = ['firstname' => rand(0, 250), 'lastname' => 'Doe', 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];
    
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['firstname' => trans('validation.string', ['attribute' => 'firstname'])]);
    }

    /**
     * @test
     * @testdox Test the firstname max 190 characters validation
     * 
     * @group users
     */
    public function validationFirstnameMax190(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(['name' => 'user']); 
        $input = ['firstname' => str_random(200), 'lastname' => 'Doe', 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];
    
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['firstname' => trans('validation.max.string', [
                'max' => 190, 'attribute' => 'firstname'
            ])]);
    }

    /**
     * @test
     * @testdox Test lastname required validation rule
     * 
     * @group users
     */
    public function validationLastnameRequired(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(['name' => 'user']);
        $input = ['firstname' => 'John', 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['lastname' => trans('validation.required', ['attribute' => 'lastname'])]);
    }

    /**
     * @test
     * @testdox Validation lastname string validation rule
     * 
     * @group users
     */
    public function validationLastnameString(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(['name' => 'user']);
        $input = ['firstname' => 'John', 'lastname' => rand(0, 100), 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];
    
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['lastname' => trans('validation.string', ['attribute' => 'lastname'])]);
    }

    /**
     * @test
     * @testdox Test lastname max 120 characters validation
     * 
     * @group users
     */
    public function validationLastnameMax120(): void 
    {
        $user  = $this->createAdminUser(); 
        $role  = factory(Role::class)->create(['name' => 'user']);
        $input = ['firstname' => 'John', 'lastname' => str_random(200), 'email' => 'John.doe@example.tld', 'name' => 'John doe', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['lastname' => trans('validation.max.string', [
                'max' => 120, 'attribute' => 'lastname'
            ])]);
    }

    /**
     * @test
     * @testdox Test role required validation
     * 
     * @group users
     */
    public function validationRoleRequired(): void 
    {
        $user  = $this->createAdminUser();
        $input = ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'John.doe@example.tld', 'name' => 'John doe']; 

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['role' => trans('validation.required', ['attribute' => 'role'])]);
    }
}
