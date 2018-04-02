<?php

namespace Tests\Feature\Helpdesk\Tickets;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;
use Misfits\Ticket;

/**
 * Class AssignedViewTest 
 * --- 
 * Testing class for the assigned ticket index view. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Helpdesk\Tickets
 */
class AssignedViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers, InputFakers;

    /**
     * @test 
     * @testdox Test the Redirect response when an authenticated user tries to access the overview page.
     */
    public function unauthenticated(): void 
    {
        $this->get(route('admin.helpdesk.tickets.assigned'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test the error response when a user with wrong role tries to access the overview page. 
     */
    public function wrongAccessRole(): void 
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.assigned'))
            ->assertStatus(403);
    }

    /**
     * @test 
     * @testdox Test the error response when blocked user tries to access the overview page.
     */
    public function blockedUser(): void 
    {
        $user = $this->createBlockedUser(); 

        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.assigned'))
            ->assertStatus(302)
            ->assertSessionHasErrors(['login' => 'This account is blocked.']);
    }

    /**
     * @test 
     * @testdox Test if a user can successfully access ther overview page.
     */
    public function success(): void 
    {
        $user = $this->createAdminUser(); 
        factory(Ticket::class)->create(['assignee_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('admin.helpdesk.tickets.assigned'))
            ->assertStatus(200);
    }
}
