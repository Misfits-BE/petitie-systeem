<?php 

namespace Misfits\Repositories;

use Misfits\Comment;
use Misfits\Ticket;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Misfits\Http\Requests\Comment\CommentValidator;

/**
 * Class COmmentRepository
 *
 * @package Misfits\Repositories
 */
class CommentRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Comment::class;
    }

    /**
     * Store a comment in the database storage. 
     * 
     * @param  Ticket               $ticket  The helpdesk ticket database entity.
     * @param  CommentsValidator    $input   The given user input (Validated)
     * @return \Misfits\Comment
     */
    public function storeHelpdeskComment(Ticket $ticket, CommentValidator $input): Comment 
    {
        $entity            = new Comment;
        $entity->author_id = $input->user()->id;
        $entity->comment   = $input->comment;

        return $ticket->comments()->save($entity);
    }
}