<?php 

namespace Misfits\Repositories;

use Misfits\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class BanRepository
 *
 * @package Misfits\Repositories
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
     * 
     * @return Ban
     */
    public function lock(User $user) 
    {
        $user->ban();
    }
}