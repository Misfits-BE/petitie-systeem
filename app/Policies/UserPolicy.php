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
     * The user is permitted to ban the user.
     *
     * @param  \Misfits\User  $user     User entity from the auth session guard.
     * @param  \Misfits\User  $model    User entity from the database storage
     * @return bool
     */
    public function banUser(User $user, User $model): bool
    {
        return $user->id !== $model->id && $user->hasRole('admin') && $model->isNotBanned();
    }

    /**
     * Authorization checker to check if the user is permitted to revoke a user ban
     *
     * @param  \Misfits\User $user      User entity from the auth session guard.
     * @param  \Misfits\User $model     user entity from the database storage.
     * @return bool
     */
    public function revokeBanUser(User $user, User $model): bool
    {
        return $user->id !== $model->id && $user->hasRole('admin') && $model->isBanned();
    }

    /**
     * Authorization checker if the authenticated user is permitted to delete a user. 
     * 
     * @param  \Misfits\User $user      User entity form the auth session guard.
     * @param  \Misfits\User $model     User entity from the database storage
     * @return bool
     */
    public function delete(User $user, User $model): bool 
    {
        return auth()->check() && $user->id === $model->id || $user->hasRole('admin');
    }
}
