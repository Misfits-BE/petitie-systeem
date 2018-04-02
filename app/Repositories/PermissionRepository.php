<?php 

namespace Misfits\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 *
 * @package Misfits\Repositories
 */
class PermissionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Permission::class;
    }

    /**
     * Get all the normal user permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserPermissions(): Collection
    {
        return $this->model->where('name', 'LIKE', 'view_%')->get();
    }
}
