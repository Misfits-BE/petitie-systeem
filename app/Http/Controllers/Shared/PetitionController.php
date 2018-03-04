<?php

namespace Misfits\Http\Controllers\Shared;

use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Requests\Shared\Petition\CreateValidator;
use Misfits\Repositories\PetitionRepository;

/**
 * Class PetitionController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Shared
 */
class PetitionController extends Controller
{
    /** @var \Misfits\Repositories\PetitionRepository $petitions */
    private $petitions; 

    /**
     * PetitionController Constructor 
     * 
     * @param  PetitionRepository $petitions DB wrapper for the petitions
     * @return void
     */
    public function __construct(PetitionRepository $petitions) 
    {
        $this->middleware(['auth', 'forbid-banned-user'])->except(['show']);
        $this->petitions = $petitions; 
    }

    /**
     * Create view for an new petition.
     * 
     * @todo Implement phpunit tests
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('shared.petitions.create');
    }

    /**
     * Show a specific petition in the system. 
     * 
     * @todo Implement phpunit tests
     * 
     * @param  string $slug The unique identifier form the petition in the system. 
     * @return \Illuminate\View\View 
     */
    public function show(string $slug): View 
    {
        return view('shared.petitions.show', [
            'petition'       => $this->petitions->findPetition($slug),
            'signatureCount' => $this->petitions->signatureCount($slug), 
            'share'          => $this->petitions->getSocialMediaLinks($slug)
        ]);
    } 

    /**
     * Create a petition in the database. 
     * 
     * @todo Implement phpunit tests
     * 
     * @param  CreateValidator $input The user given input. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]);
        
        if ($petition = $this->petitions->create($input->except('_token', 'image'))) {
            flash("Your petition has been created.")->success();
        }

        return redirect()->route('petitions.show', ['slug' => $petition->slug]);
    }
}
