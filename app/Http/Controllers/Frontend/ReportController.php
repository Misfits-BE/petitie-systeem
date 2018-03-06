<?php

namespace Misfits\Http\Controllers\Frontend;

use Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\PetitionRepository;

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

    /**
     * ReportController constructor 
     * 
     * @param  PetitionRepository $petitions DB wrapper for the petitions
     * @return void
     */
    public function __construct(PetitionRepository $petitions) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->petitions = $petitions;
    }

    /**
     * View for reporiting a petition in the system. 
     * 
     * @todo Implement phpunit tests (not authenticated, banned user, success)
     * 
     * @param  string $slug  The unique identifier from the petition in the database
     * @return \Illuminate\View\View
     */
    public function create(string $slug): View 
    {
        $petition       = $this->petitions->findPetition($slug);
        $signatureCount = $petition->signatures->count(); 

        $this->authorize('report-petition', $petition);

        return view('frontend.reports.index', compact('petition', 'signatureCount'));
    } 
}
