<?php

namespace Tests\Feature\Helpdesk\Comments;

use Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\InputFakers;
use Tests\Traits\CreatesUsers;
use Misfits\Ticket;

/**
 * Class CreateCommentTest 
 * --- 
 * Class for tsting the comment store method. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Helpdesk\Comments
 */
class CreateCommentTest extends TestCase
{
    use RefreshDatabase, InputFakers, CreatesUsers;

    /**
     * @test
     * @testdox Test the redirect response for some unauthenticated user.
     */
    public function unauthenticated(): void 
    { 
        $ticket = factory(Ticket::class)->create();

        $this->post(route('comment.store', ['slug' => $ticket->slug]), $this->fakeCommentInput())
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the error response when a blocked user tries to store an comment.
     */
    public function blockedAccess(): void
    {
        $user   = $this->createBlockedUser(); 
        $input  = $this->fakeCommentInput();
        $ticket = factory(Ticket::class)->create();
        
        $this->actingAs($user)
            ->post(route('comment.store', ['slug' => $ticket->slug]), $input)
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test the validation class for a new comment store method.
     */
    public function validationErrors(): void 
    {
        $ticket = factory(Ticket::class)->create(); 
        $user   = $this->createNormalUser();

        $this->actingAs($user)
            ->post(route('comment.store', ['slug' => $ticket->slug]), [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['comment' => 'The comment field is required.']);
    }

    /**
     * @eest
     * @testdox Test if an user can successfully store a comment in the storage
     */
    public function success(): void 
    {
        $ticket  = factory(Ticket::class)->create();

        $user  = $this->createNormalUser(); 
        $input = $this->fakeCommentInput();

        Gate::before(function (): bool { return true; });

        $this->actingAs($user)
            ->post(route('comment.store', ['slug' => $ticket->slug]), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]));
    
        $this->assertDatabasehas('comments', [
            'author_id' => $user->id, 'ticket_id' => $ticket->id, 'comment' => $input['comment']
        ]);
    }
}
