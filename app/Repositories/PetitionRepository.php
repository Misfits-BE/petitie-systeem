<?php 

namespace Misfits\Repositories;

use Share;
use Misfits\Petition;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Collection;

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
     * @param  string $slug The unique identifier from the petition in the system. 
     * @return int 
     */
    public function signatureCount(string $slug): int
    {
        return $this->findPetition($slug)->signatures()->count();
    }

    /**
     * Get the shareable links for the petition 
     * 
     * @param  string $slug The unique identifier from the petition in the database. 
     * @return array
     */
    public function getSocialMediaLinks(string $slug): array
    {
        $petition = $this->findPetition($slug);

        return Share::load(route('petitions.show', ['slug' => $petition->slug]), $petition->title)
            ->services('facebook', 'twitter');
    }

    /**
     * Get the 6 latest petitions in the application for the frontpage. 
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getPetitionsFrontPage(): Collection
    {
        return $this->entity()->orderBy('created_at', 'DESC')->take(6)->get();        
    }
}