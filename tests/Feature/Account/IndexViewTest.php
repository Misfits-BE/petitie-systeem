<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class IndexViewTest
 * ---- 
 * PHPunit testsuite for the account settings view; 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Account
 */
class IndexViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test if a guest user can't access the profile setting page.
     */
    public function unauthenticated(): void 
    {
        $this->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test if a banned user can't access the profile settings page.
     */
    public function bannedUser(): void 
    {
        $user = $this->createBlockedUser(); 

        $this->actingAs($user)
            ->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test if an authenticated user can view the profile settings page. 
     */
    public function success(): void 
    {
        $user = $this->createNormalUser(); 

        $this->actingAs($user)
            ->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(200);
    }
}
