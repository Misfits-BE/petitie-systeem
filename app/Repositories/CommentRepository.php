<?php 

namespace Misfits\Repositories;

use Misfits\Comment;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class COmmentRepository
 *
 * @package Misfits\Repositories
 */
class CommentRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Comment::class;
    }
}