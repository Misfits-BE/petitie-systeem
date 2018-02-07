<?php 

namespace Misfits\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Role;

/**
 * Class RoleRepository
 *
 * @package Misfits\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * Create a new ACL role in the system. When the given data is not found. 
     * 
     * @param  array $role  The given data that needs to be checked or inserted. 
     * @return \Spatie\Permission\Models\Role
     */
    public function firstOrCreate(array $role): Role
    {
        return $this->model->firstOrCreate($role);
    }
}