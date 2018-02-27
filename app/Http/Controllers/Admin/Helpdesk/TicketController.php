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
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user'])->except(['show']); 
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
            'tickets' => $this->tickets->getOpenTickets($input->term) // TODO: Build up the function
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
        $ticket = $this->tickets->findBy('slug', $slug);

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

        return back(Response::HTTP_FOUND);
    }

    /**
     * Function for closing a ticket in the database storage. 
     * 
     * @param  string  $slug  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(): RedirectResponse 
    {
        $ticket = $this->tickets->findBy('slug', $slug); 

        if ($ticket->update()) {

        }
    }
}
