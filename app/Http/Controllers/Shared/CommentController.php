<?php

namespace Misfits\Http\Controllers\Shared;

use Gate;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\CommentRepository;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Requests\Comment\CommentValidator;
use Misfits\Repositories\TicketRepository;

/**
 * Class CommentController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Shared
 */
class CommentController extends Controller
{
    /** @var \Misfits\Repositories\CommentRepository $comments */
    private $comments; 

    /** @var \Misfits\Repositories\TicketRepository $tickets */
    private $tickets;

    /**
     * CommentController constructor
     * 
     * @param  CommentRepository  $comments The abstraction layer between controller and database related logic.
     * @return void
     */
    public function __construct(CommentRepository $comments, TicketRepository $tickets) 
    {
        $this->middleware(['auth']);

        $this->comments = $comments;
        $this->tickets  = $tickets;
    }

    /** 
     * Store a new comment in the database
     * 
     * @param  CommentValidor $input The user given input (Validated).  
     * @param  string         $slug  The slug for the comment helpdesk ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentValidator $input, string $slug): RedirectResponse
    {
        $ticketEntity = $this->tickets->findBy('slug', $slug);

        if (Gate::allows('comment', $ticketEntity)) {
            $this->comments->storeHelpdeskComment($ticketEntity, $input);
        }

        return redirect()->route('admin.helpdesk.tickets.show', ['slug' => $slug]);
    }
}
