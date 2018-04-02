<?php

namespace Misfits\Policies;

use Misfits\User;
use Misfits\Petition;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PetitionPolicy
 * --- 
 * Authorizaation checker for the petition checker. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Policies
 */
class PetitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is quest or authenticated en can block the petition
     *
     * @param  \Misfits\User      $user         The user entity from the database. 
     * @param  \Misfits\Petition  $petition     The petition entity form the database. 
     * @return bool
     */
    public function reportPetition(User $user, Petition $petition): bool
    {
        return auth()->check() && $user->id !== $petition->author_id;
    }
}
