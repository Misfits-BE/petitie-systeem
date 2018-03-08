<?php

namespace Tests\Feature\Notifications;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class IndexViewTest 
 * ---- 
 * PHPUnit test suite for testing the notifications index page.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Notifications
 */
class IndexViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test the notifations index view when there are no notifications
     */
    public function successNoData(): void 
    {
        factory(DatabaseNotification::class)->create();
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('notifications.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test the notifications index page when there are notifications found. 
     */
    public function successWithPagination(): void 
    {
        factory(DatabaseNotification::class, 20)->create();
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->get(route('notifications.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox  Test the response when a quest tries to view the notifications index page
     */
    public function unauthenticated(): void 
    {
        $this->get(route('notifications.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox test the response when a banned user tries to view the notifications index page. 
     */
    public function bannedUser(): void 
    {
        $user = $this->createBlockedUser();

        $this->actingAs($user)
            ->get(route('notifications.index'))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }
}
