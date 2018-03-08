<?php 

namespace Misfits\Repositories;

use Misfits\Petition;
use Misfits\Signature;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Misfits\Http\Requests\Frontend\SignatureValidator;

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

    /**
     * Store the signature data for the petition that is found based by the slug. 
     * 
     * @param  SignatureValidator   $input     The user given input. (Validated)
     * @param  Petition             $petition  De petiution entity from the database storage
     * @return \Misfits\Signature
     */
    public function store(SignatureValidator $input, Petition $petition): Signature
    {
        $signature             = new Signature;
        $signature->country_id = $input->country_id;
        $signature->firstname  = $input->firstname;
        $signature->lastname   = $input->lastname; 
        $signature->city       = $input->city;
        $signature->email      = $input->email;

        return $petition->signatures()->save($signature);
    }
}