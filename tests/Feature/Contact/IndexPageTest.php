<?php

namespace Tests\Feature\Contact;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class IndexTest
 * ---- 
 * PHPunit testsuite for testing out the application contact pages. 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Contact
 */
class IndexPageTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if a quest user can view the contact page without errors
     */
    public function indexNotAuthenticated(): void
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if an authenticated user can view the contact page without errors
     */
    public function indexAuthenticated(): void 
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('contact.index'))
            ->assertStatus(200);
    }
}
