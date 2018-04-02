<?php

namespace Tests\Feature\Reports;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\Petition;
use Tests\Traits\CreatesUsers;
use Misfits\Category;

/**
 * Class CreateViewTest
 * ---
 * PHPUnit test suite for creating petition reports 
 * 
 * @author
 * @copyright   
 * @package     Tests\Feature\Reports
 */
class CreateViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test if a guest user can't access the report petition page.
     */
    public function unauthenticated(): void 
    {
        $petition = factory(Petition::class)->create();

        $this->get(route('petition.report', ['slug' => $petition->slug]))
            ->assertStatus(302)
            ->assertredirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a banned user can't access the petition report page.
     */
    public function bannedUser(): void 
    {
        $user     = $this->createBlockedUser(); 
        $petition = factory(Petition::class)->create();
        
        $this->actingAs($user)
            ->get(route('petition.report', ['slug' => $petition->slug]))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test if an authenticated can display the petition report page without errors.
     */
    public function noErrors() 
    {
        factory(Category::class)->create(['module' => 'reporting']); 

        $user     = $this->createNormalUser(); 
        $petition = factory(Petition::class)->create();

        $this->actingAs($user)
            ->get(route('petition.report', ['slug' => $petition->slug]))
            ->assertStatus(200);
    }
}
