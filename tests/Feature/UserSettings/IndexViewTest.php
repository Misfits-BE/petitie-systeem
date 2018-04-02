<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class IndexViewTest
 * -----
 * Testcase for the user settings view. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\UserSettings
 */
class IndexViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test a guest user can't acccess the account settings page. 
     */
    public function notAuthenticated(): void 
    {
        $this->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test if an blocked user can't access his account settings.
     */
    public function blockedUser(): void 
    {
        $user = $this->createBlockedUser();

        $this->actingAs($user)
            ->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test if an authenticated can view his account settings.
     */
    public function authenticated(): void 
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(200);
    }
}
