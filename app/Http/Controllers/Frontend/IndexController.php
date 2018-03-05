<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\PetitionRepository;

/**
 * Class IndexController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and hos contributors
 * @package     Misfits\Http\Controllers\Frontend
 */
class IndexController extends Controller
{
    /**
     * Frontpage voor de applicatie 
     * 
     * @param  PetitionRepository $petitions DB Wrapper for the petitions. 
     * @return \Illuminate\View\View
     */
    public function index(PetitionRepository $petitions): View 
    {
        return view('welcome', ['petitions' => $petitions->getPetitionsFrontPage()]);
    }
}
