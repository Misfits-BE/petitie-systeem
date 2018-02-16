<?php

namespace Misfits\Http\Controllers\Frontend;

use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Frontend\HelpdeskValidator;
use Misfits\Repositories\CategoryRepository;
use Misfits\Repositories\TicketRepository;

/**
 * Controller for letting user creating support tickets.
 *
 * @author 		Tim Joosten <tim@activisme.be>
 * @copyright	2018 Tim Joosten and contributors
 * @package 	\Misfits\Http\Controllers\Frontend
 */
class HelpdeskController extends Controller
{
    /** @var \Misfits\Repositories\CategoryRepository $categories */
    private $categories;

    /** @var \Misfits\Repositories\TicketRepository $helpdesk */
    private $helpdesk;

    /**
     * HelpdeskController constructor
     *
     * @param  TicketRepository   $helpdesk     ABstraction layer between controller, logic, database
     * @param  CategoryRepository $categories   Abstraction layer between controller, logic, database
     * @return void
     */
    public function __construct(CategoryRepository $categories, TicketRepository $helpdesk)
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->categories = $categories;
        $this->helpdesk   = $helpdesk;
    }

    /**
     * Get the helpdesk ticket that the user has been created.
     * 
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        //
    }

    /**
     * Show a specific helpdesk ticket in the application.
     * ----
     * This controller and route is used by users and admins.
     *
     * @param  int $ticket  The unique identifier in the database storage
     * @return mixed
     */
    public function show(int $ticket)
    {
        $ticket = $this->helpdesk->findOrFail($ticket);

        if (Gate::allows('view', $ticket)) {
            return view('frontend.helpdesk.show', compact('ticket'));
        }
        
        return redirect()->route('helpdesk.index');
    }

    /**
     * Create view for the user his helpdesk question.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('frontend.helpdesk.create', [
            'categories' => $this->categories->whereIn('module', ['helpdesk'], ['id', 'name'])
        ]);
    }

    /**
     * Store method for the user his helpdesk ticket.
     *
     * @param  HelpdeskValidator $input     The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HelpdeskValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]);

        if ($ticket = $this->helpdesk->create($input->all())) {
            flash('Your helpdesk ticket has been created.')->success();
        }

        return redirect()->route('helpdesk.show', $ticket);
    }
}
