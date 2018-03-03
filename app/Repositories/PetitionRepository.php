<?php 

namespace Misfits\Repositories;

use Misfits\Petition;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class PetitionRepository
 *
 * @package Misfits\Repositories
 */
class PetitionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Petition::class;
    }

    /**
     * Find a specific petition in the storage based on the slug. 
     * 
     * @param  string $slug The unique identifier form the petition in the system. 
     * @return \Misfits\Petition
     */
    public function findPetition(string $slug): Petition 
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    /**
     * Count all the signatures for a given petition. 
     * 
     * @param  string $slug The unique identifier form the petition in the system. 
     * @return int 
     */
    public function signatureCount(string $slug): int
    {
        return $this->findPetition($slug)->signatures()->count();
    }
}