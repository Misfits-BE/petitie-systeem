<?php

namespace Tests\Feature\Helpdesk\Tickets;

use Tests\TestCase;
use Gate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Misfits\Comment;

/**
 * Class CloseTicketTest 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Helpdesk\Tickets
 */
class CloseTicketTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test is if an unauthenticated can't delete a helpdesk ticket comment. 
     */
    public function unauthenticated(): void 
    {
        $this->get(route('comment.delete', factory(Comment::class)->create()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test if an blocked user can't delete a helpdesk ticket comment. 
     */
    public function blockedAccess(): void 
    {
        $user    = $this->createBlockedUser(); 
        $comment = factory(Comment::class)->create(); 

        $this->actingAs($user)
            ->get(route('comment.delete', $comment))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test the response when a helpdesk ticket comment successfully has been deleted. 
     */
    public function correctPermissionValidId(): void 
    {
        $user    = $this->createNormalUser(); 
        $comment = factory(Comment::class)->create(['author_id' => $user->id]); 

        Gate::before(function (): bool { return true; });

        $this->assertDatabaseHas('comments', ['id' => $comment->id]);

        $this->actingAs($user)
            ->get(route('comment.delete', $comment))
            ->assertStatus(302);

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    /**
     * @test
     * @testdox Test the error response when a comment with wrong id will be deleted.
     */
    public function correctPermissionInValidId(): void 
    {
        $user = $this->createNormalUser();

        Gate::before(function (): bool { return true; });

        $this->actingAs($user)
            ->get(route('comment.delete', ['comment' => 1000]))
            ->assertStatus(404);
    }
}
