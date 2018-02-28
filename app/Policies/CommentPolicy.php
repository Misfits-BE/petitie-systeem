<?php

namespace Misfits\Policies;

use Misfits\User;
use Misfits\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CommentPolicy 
 * --- 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Misfits\Policies
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \Misfits\User     $user      Entity from the currently authenticated user.
     * @param  \Misfits\Comment  $comment   Database entity from the comment in the storage.
     * @return mixed
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->author_id;
    }
}
