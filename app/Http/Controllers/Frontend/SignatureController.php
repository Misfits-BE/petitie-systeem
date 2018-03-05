<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\SignatureRepository;

/**
 * Class SignatureController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Misfits\Http\Controllers\Frontend
 */
class SignatureController extends Controller
{
    /** @var \Misfits\Repositories\SignatureRepository $signatures */
    private $signatures; 

    /**
     * SignatureController constrcutor 
     * 
     * @return void
     */
    public function __construct(SignatureRepository $signatures) 
    {
        //
    }

    public function store(): RedirectResponse 
    {

    }
}
