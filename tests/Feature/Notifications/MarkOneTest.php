<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Illuminate\Notifications\DatabaseNotification;

/**
 * Class NarkOneTest
 * ---- 
 * PHPUnit testsuite for marking one notification as read. 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Notifications
 */
class MarkOneTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test if an unauthenticated user can't mark a notification as read.
     */
    public function unauthenticated(): void 
    {
        $notification = factory(DatabaseNotification::class)->create();

        $this->get(route('notifications.markOne', ['id' => $notification->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if an authenticated user can mark a notification as read. 
     */
    public function success(): void
    {
        $notification = factory(DatabaseNotification::class)->create([
            'data' => '{"url": "https://www.example.tld"}'
        ]);

        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->get(route('notifications.markOne', ['id' => $notification->id]))
            ->assertStatus(302)
            ->assertSessionhas([
                $this->flashSession . '.level' => 'success'
            ]);
    }

    /**
     * @test 
     * @testdox
     */
    public function wrongId(): void 
    {
        //
    }

    /**
     * @test
     * @testdox
     */
    public function bannedUser(): void 
    {

    }
}
