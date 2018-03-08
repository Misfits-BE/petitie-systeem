<?php

namespace Tests\Feature\Notifications;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class MarkAllAsReadTest
 * ---
 * PHPUnit testcase for testing that all unread notification can be
 * marked as read.
 *
 * @package Tests\Feature\Notifications
 */
class MarkAllAsReadTest extends TestCase
{
    use CreatesUsers, RefreshDatabase;

    /**
     * @test
     * @testdox Test is a quest user can't mark notifications as read.
     */
    public function unauthenticated(): void
    {
        $this->get(route('notifications.markAll'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a banned user can't mark all notifications as read.
     */
    public function bannedUser(): void
    {
        $user = $this->createBlockedUser();

        $this->actingAs($user)
            ->get(route('notifications.markAll'))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test if a user can mark all his unread notifications as read.
     */
    public function success(): void
    {
        $user = $this->createNormalUser();

        factory(DatabaseNotification::class)->create([
            'notifiable_id' => $user->id, 'notifiable_type' => 'Misfits\User'
        ]);
    }
}
