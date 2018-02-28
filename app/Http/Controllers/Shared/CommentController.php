<?php

namespace Misfits\Http\Controllers\Shared;

use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\CommentRepository;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Requests\Comment\CommentValidator;

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

    /**
     * CommentController constructor
     * 
     * @param  CommentRepository  $comments The abstraction layer between controller and database related logic.
     * @return void
     */
    public function __construct(CommentRepository $comments) 
    {
        $this->middleware(['auth']);
        $this->comments = $comments;
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
        //
    }
}
