<?php

namespace Tests\Feature\Petitions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\Country;
use Misfits\Petition;

/**
 * Class ShowPetitionTest 
 * ---
 * Clpass for testing that a user can show specific petitions. 
 * 
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Petitions
 */
class ShowPetitionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test if a user can view a petition without problems. 
     */
    public function success(): void 
    {
        factory(Country::class)->create(); // No variable assignment because it's not needed in params.
        $petition = factory(Petition::class)->create();

        $this->get(route('petitions.show', ['slug' => $petition->slug]))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test he error response when the user try to visit a petition with invalid id
     */
    public function wrongIdentifier(): void
    {
        $this->get(route('petitions.show', ['slug' => 'blaat']))
            ->assertStatus(404);
    }
}
