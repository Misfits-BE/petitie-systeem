<?php

namespace Misfits\Http\Controllers\Admin\Helpdesk;

use Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\TicketRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TicketController
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Admin\Helpdesk
 */
class TicketController extends Controller
{
    /** @var \Misfits\Repositories\TicketRepository $tickets */
    private $tickets; 

    /**
     * TicketController constructor
     * 
     * @param  TicketRepository $tickets Abstraction layer between controller and database
     * @return void
     */
    public function __construct(TicketRepository $tickets)
    {
        $this->middleware(['auth', 'forbid-banned-user', 'role:admin'])->except(['show', 'close']); 
        $this->tickets = $tickets;
    }

    /**
     * The index management view for the helpdesk tickets.   
     *  
     * @todo Implement phpunit tests
     * 
     * @param  Request $input The user given input (Not validated)
     * @return \Illuminate\View\View
     */
    public function index(Request $input): View 
    {
        return view('admin.helpdesk.tickets.open-tickets', [
            'tickets'    => $this->tickets->getOpenTickets($input->term), 
            'searchTerm' => route('admin.helpdesk.tickets')
        ]);
    }

    /**
     * Get all the assigned tickets to the authenticated user. 
     * 
     * @param  Request $input The user given input (Notvalidated.)
     * @return \Illuminate\View\View
     */
    public function userAssigned(Request $input): View
    {
        $user = auth()->user();

        return view('admin.helpdesk.tickets.open-tickets', [
            'tickets'   => $this->tickets->getAssignedTickets($input->term, $user),
            'searchUrl' => route('admin.helpdesk.tickets.assigned')
        ]); 
    }

    /**
     * Show a specific helpdesk ticket in the application. 
     *  
     * @todo Implement phpunit tests
     * 
     * @param  string  $slug  The unique identifier in the database storage
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View 
    { 
        $ticket = $this->tickets->with(['comments.author'])->findBy('slug', $slug);

        if (Gate::denies('view', $ticket)) { //! Authencated user is not permitted to view the helpdesk ticket.
            //! So throw some HTTP/1 404 - Not Found response all over the place. 
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('admin.helpdesk.tickets.show', compact('ticket')); // TODO: Build up the view
    }

    /**
     * Function for assigning a ticket to yourself
     * 
     * @todo Implement phpunit tests
     * 
     * @param  string  $slug  The unique identifier form the ticket in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assign(string $slug): RedirectResponse 
    {
        $user   = auth()->user()->id;
        $ticket = $this->tickets->findBy('slug', $slug); 

        if ($ticket->update(['assignee_id' => $user])) {
            flash('The ticket has been assigned to you.')->info()->important();
        }

        return redirect()->route('admin.helpdesk.tickets.show', $ticket);
    }

    /**
     * Function for closing a ticket in the database storage. 
     * 
     * @param  string  $slug   The uniqie identifier from the ticket in the database storage
     * @param  string  $status The status for the ticket. Can only be open or closed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(string $slug, string $status): RedirectResponse 
    {
        $ticket = $this->tickets->findBy('slug', $slug);

        if (Gate::allows('view', $ticket) && $this->tickets->openClose($ticket, $status)) {
            $this->logActivity($ticket, auth()->user()->id . ' closed a support ticket');
        }

        return redirect()->route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]);
    }
}
