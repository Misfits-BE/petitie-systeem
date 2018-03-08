<?php 

namespace Misfits\Repositories;

use Misfits\Country;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CountryRepository
 *
 * @package Misfits\Repositories
 */
class CountryRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Country::class;
    }
}