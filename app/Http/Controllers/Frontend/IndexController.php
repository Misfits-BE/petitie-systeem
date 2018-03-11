<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\PetitionRepository;
use Misfits\Repositories\CategoryRepository;

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
     * @param  PetitionRepository $petitions    DB Wrapper for the petitions. 
     * @param  CategoryRepository $categories   DB Wrapper for the petition categories.
     * @return \Illuminate\View\View
     */
    public function index(PetitionRepository $petitions, CategoryRepository $categories): View 
    {
        return view('welcome', [
            'petitions'  => $petitions->getPetitionsFrontPage(),
            'categories' => $categories->entity()->where('module', 'petition', ['slug', 'name'])->get()
        ]);
    }
}
