<?php

namespace Misfits\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misfits\Ticket;
use Misfits\User;

/**
 * Helpdesk Authorization policy
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Policies
 */
class HelpdeskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \Misfits\User    $user       Database entity from the authenticated usser.
     * @param  \Misfits\Ticket  $ticket     Database entity from the ticket
     * @return bool
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->author_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can comment on the ticket.
     *
     * @param  \Misfits\User    $user       Database entity from the authenticated usser.
     * @param  \Misfits\Ticket  $ticket     Database entity from the ticket
     * @return bool
     */
    public function comment(User $user , Ticket $ticket): bool 
    {
        return $user->id === $ticket->author_id || $user->hasRole('admin');
    }

    /**
     * Determine if the authenticated can update the ticket
     * 
     * @param  \Misfits\User    $user       Database entity from the authenticated user
     * @param  \Misfits\Ticket  $ticket     Database entity from the ticket
     * @return bool
     */
    public function update(User $user, Ticket $ticket): bool 
    {
        return $user->id === $ticket->author_id;
    }
}
