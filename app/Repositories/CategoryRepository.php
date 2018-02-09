<?php 

namespace Misfits\Repositories;

use Misfits\Category;
use Illuminate\Pagination\Paginator;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CategoryRepository
 *
 * @package Misfits\Repositories
 */
class CategoryRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    /**
     * Paginate all the helpdesk categories?
     *
     * @param  int $perPage  The amount off records u want to display per page.
     * @return  \Illuminate\Pagination\Paginator
     */
    public function getHelpdeskCategories(int $perPage): Paginator
    {
        return $this->model->where('module', 'helpdesk')->simplePaginate($perPage, [
            'id', 'name', 'color', 'description'
        ]);
    }
}