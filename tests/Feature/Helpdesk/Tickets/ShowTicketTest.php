<?php

namespace Tests\Feature\Helpdesk\Tickets;

use Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use phpDocumentor\Reflection\Types\Void_;
use Misfits\Ticket;

/**
 * Class ShowTicketTest
 * ----
 * PHPUnit tests for the displaying off tickets in the system. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten And his contributors
 * @package     Tests\Feature\Helpdesk\Tickets
 */
class ShowTicketTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test
     * @testdox Test if a banned user can't display a helpdesk ticket
     */
    public function bannedUser(): void 
    {
        $user   = $this->createBlockedUser(); 
        $ticket = factory(Ticket::class)->create(['author_id' => $user->id]); 
        
        Gate::before(function () : bool {
            return true; 
        });

        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]))
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test
     * @testdox Test the error response when a user tries to display a ticket with the wrong identifier
     */
    public function wrongId(): void 
    {
        $user = $this-> createAdminUser(); 
        
        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.show', ['slug' => 'some-slug']))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test if a permitted can display the ticket without any problems. 
     */
    public function success(): void 
    {
        $user   = $this->createAdminUser(); 
        $ticket = factory(Ticket::class)->create(['author_id' => $user->id]); 
        
        Gate::before(function () : bool {
            return true; 
        });

        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test the response when a quest user try to display a ticket
     */
    public function unauthenticated(): void 
    {
        $ticket = factory(Ticket::class)->create();

        $this->get(route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
