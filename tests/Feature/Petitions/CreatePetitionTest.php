<?php

namespace Tests\Feature\Petitions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Misfits\Petition;
use Misfits\Country;

/**
 * Class CreatePetitionTest 
 * --- 
 * Class for testing the view when a user wants to create a petition. 
 * 
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Petitions
 */
class CreatePetitionTest extends TestCase
{
    use RefreshDatabase, CreatesUsers; 

    /**
     * @test 
     * @testdox Test the error response when a unauthenticated user wants to create a petition
     */
    public function unauthenticated(): void 
    {
        $this->get(route('petitions.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test is a blocked user can't access the petition create page.
     */
    public function bannedUser(): void 
    {
        $user = $this->createBlockedUser();

        $this->actingAs($user)
            ->get(route('petitions.create'))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test if an authenticated can display the petition create view.
     */
    public function success(): void 
    {
        factory(Country::class)->create(); // No variable assignment because it's not needed in params.
        
        $user       = $this->createNormalUser();
        $petition   = factory(Petition::class)->create();

        $this->actingAs($user)
            ->get(route('petitions.create'))
            ->assertStatus(200);
    }
}
