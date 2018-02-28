<?php

namespace Misfits\Http\Controllers\Shared;

use Gate;
use Misfits\Comment;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\CommentRepository;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Requests\Comment\CommentValidator;
use Misfits\Repositories\TicketRepository;
use Symfony\Component\HttpFoundation\Response;

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
     * @param  TicketRepository   $tickets  The abstraction layer bewteen controller and database related logic.
     * @return void
     */
    public function __construct(CommentRepository $comments, TicketRepository $tickets) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->comments = $comments;
        $this->tickets  = $tickets;
    }

    /** 
     * Store a new comment in the database
     * 
     * @todo Implement phpunit tests
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

    /**
     * Delete a comment in the database storage. 
     * 
     * @param  Comment $comment The database entity from the comment.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse 
    {
        $this->authorize('delete', $comment);
        $comment->delete(); 

        return back(Response::HTTP_FOUND);
    }
}
