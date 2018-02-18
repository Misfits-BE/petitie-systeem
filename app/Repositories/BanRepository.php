<?php 

namespace Misfits\Repositories;

use Misfits\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Cog\Laravel\Ban\Models\Ban;

/**
 * Class BanRepository
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Repositories
 */
class BanRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * Method for notifying and banning users in the application 
     *
     * @todo Implement mail notification.
     * @todo Implement ban logic
     *  
     * @param  string       $reason The reason why the user is banned.
     * @param  Misftis\User $user   The user that returned from the database storage
     * @return \Cog\Laravel\Ban\Models\Ban
     */
    public function lock(User $user, string $input): Ban
    {
        return $ban;
    }
}