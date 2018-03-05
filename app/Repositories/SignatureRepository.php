<?php 

namespace Misfits\Repositories;

use Misfits\Signature;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class SignatureRepository
 *
 * @package Misfits\Repositories
 */
class SignatureRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Signature::class;
    }
}