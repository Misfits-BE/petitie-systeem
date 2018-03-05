<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\SignatureRepository;
use Misfits\Http\Requests\Frontend\SignatureValidator;
use Symfony\Component\HttpFoundation\Response;
use Misfits\Repositories\PetitionRepository;

/**
 * Class SignatureController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Misfits\Http\Controllers\Frontend
 */
class SignatureController extends Controller
{
    /** @var \Misfits\Repositories\SignatureRepository $signature */
    private $signature; 

    /** @var \Misfits\Repositories\PetitionRepository $petition */
    private $petition;

    /**
     * SignatureController Constructor 
     * 
     * @param  SignatureRepository $signature   DB wrapper for the petition signature logic
     * @param  PetitionRepository  $petition    DB wrapper for the petition logic.
     * @return void
     */
    public function __construct(SignatureRepository $signature, PetitionRepository $petition) 
    {
        $this->signature = $signature; 
        $this->petition  = $petition;
    }

    /**
     * Store a new signature in the database. 
     * 
     * @todo Implement phpunit test 
     * @todo Build up validator class
     * @todo Register validation class
     * 
     * @param  SignatureValidator $input The given user input (validated)
     * @param  string             $slug  The unique identifier in the storage from the petition. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SignatureValidator $input, string $slug): RedirectResponse 
    {
        // TODO: Implement store logic (HasMany) -> Repository
        
        if ($this->signature->store($input->all(), $petition)) {
            flash('You have signed the petitions.')->success();
        }

        return back(Response::HTTP_FOUND);
    }
}
