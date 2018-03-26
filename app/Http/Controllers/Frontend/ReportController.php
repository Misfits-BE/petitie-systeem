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
use Misfits\Repositories\UserRepository;
use Misfits\Notifications\PetitionReported;

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
    private $petitions;  /** @var \Misfits\Repositories\PetitionRepository $petitions */
    private $categories; /** @var \Misfits\Repositories\CategoryRepository $categories */
    private $users;      /** @var \Misfits\Repositories\UserRepository     $users */

    /**
     * ReportController constructor 
     * 
     * @param  PetitionRepository $petitions   DB wrapper for the petitions
     * @param  CategoryRepository $categories  DB wrapper for the categories
     * @return void
     */
    public function __construct(PetitionRepository $petitions, CategoryRepository $categories, UserRepository $users) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->petitions    = $petitions;
        $this->categories   = $categories;
        $this->users        = $users;
    }

    /**
     * View for reporiting a petition in the system.
     *
     * @param  string $slug The unique identifier from the petition in the database
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
     * @todo Implement phpunit tests (validation errors, not banned user, success, petition owner)
     * 
     * @param  ReportValidator $input  The user given input. (Validated)
     * @param  string          $slug   The unique identifier from the petition in the database storage. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(ReportValidator $input, string $slug): RedirectResponse 
    {
        $petition   = $this->petitions->findPetition($slug);
        $reportMeta = ['category' => $input->category, 'description' => $input->description];

        if (Gate::allows('report-petition', $petition)) {
            if ($petition->report(['reason' => $input->subject, 'meta' => $reportMeta], auth()->user())) {
                foreach ($this->users->getByRole('admin') as $user) {
                    $user->notify((new PetitionReported($petition))->delay(now()->addMinute()));
                }

                flash("Your report on the petition has been saved.")->success()->important();
            }
        }

        return redirect()->route('petitions.show', ['slug' => $petition->slug]);
    }
}
