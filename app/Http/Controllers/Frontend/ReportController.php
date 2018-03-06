<?php

namespace Misfits\Http\Controllers\Frontend;

use Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\PetitionRepository;
use Misfits\Http\Requests\Frontend\ReportValidator;
use Misfits\Repositories\CategoryRepository;

/**
 * Class ReportController 
 * ---
 * Class for the reporting system (petition)
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 and his contributors
 * @package     Misfits\Http\Controllers\Frontend
 */
class ReportController extends Controller
{
    /** @var \Misifts\Repositories\PetitionRepository $petitions */
    private $petitions; 

    /** @var \Misfits\Repositories\CategoryRepository $categories */
    private $categories; 

    /**
     * ReportController constructor 
     * 
     * @param  PetitionRepository $petitions   DB wrapper for the petitions
     * @param  CategoryRepository $categories  DB wrapper for the categories
     * @return void
     */
    public function __construct(PetitionRepository $petitions, CategoryRepository $categories) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->petitions    = $petitions;
        $this->categories   = $categories;
    }

    /**
     * View for reporiting a petition in the system. 
     * 
     * @todo Implement phpunit tests (not authenticated, banned user, success, petition owner)
     * @todo Implement categories
     * 
     * @param  string $slug  The unique identifier from the petition in the database
     * @return \Illuminate\View\View
     */
    public function create(string $slug): View 
    {
        $petition       = $this->petitions->findPetition($slug);
        $signatureCount = $petition->signatures->count(); 
        $categories     = $this->categories->whereIn('module', ['reporting'], ['name']);

        $this->authorize('report-petition', $petition);

        return view('frontend.reports.index', compact('petition', 'signatureCount', 'categories'));
    } 

    /**
     * Store a new petition report in the database. 
     * 
     * @todo Build up the validator 
     * @todo Register route 
     * @todo Implement phpunit tests (validation errors, not authentcated, banned user, success, petition owner)
     * 
     * @param  ReportValidator $input  The user given input. (Validated)
     * @param  string          $slug   The unique identifier from the petition in the database storage. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(ReportValidator $input, string $slug): RedirectResponse 
    {
        $petition   = $this->petitions->findPetition($slug);
        
        // Report meta data for filling the ticket in the backend overview.
        $reportMeta = ['category' => $input->category, 'description' => $input->description];

        if (Gate::allows('report-petition', $petition)) { //! Authenticated user is permitted to perform the action.
            if ($petition->report(['reason' => $input->subject, 'meta' => $reportMeta], auth()->user())) { //! The petition is reported
                flash("Your report on the petition has been saved.")->success()->important();
            }
        }

        return redirect()->route('petitions.show', ['slug' => $petition->slug]);
    }
}
