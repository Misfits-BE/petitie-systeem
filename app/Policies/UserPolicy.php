<?php

namespace Misfits\Policies;

use Misfits\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * User authorization policy.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Policy for checking is the db user is the same then the authenticated user.
     *
     * @param  \Misfits\User  $user     User entity from the auth session guard.
     * @param  \Misfits\User  $model    User entity from the database storage
     * @return bool
     */
    public function sameUser(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }
}
