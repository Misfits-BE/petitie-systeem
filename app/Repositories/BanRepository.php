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
     *
     * @param  \Misfits\User $user   The user that returned from the database storage
     * @param  string       $reason The reason why the user is banned.
     * @return \Cog\Laravel\Ban\Models\Ban
     */
    public function lock(User $user, string $reason): Ban
    {
        return $user->ban(['comment' => $reason, 'expired_at' => '+2 weeks']);
    }

    /**
     * Revoke a user ban in the system.
     *
     * @todo Implementation notification mail.
     *
     * @param  \Misfits\User $user The data from the user where te bans need to revoked.
     * @return void
     */
    public function unlock(User $user): void
    {
        $user->unban();
    }
}