<?php 

namespace Misfits\Repositories;

use Misfits\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class UserRepository
 *
 * @package Misfits\Repositories
 */
class UserRepository extends Repository
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
}