<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;

/**
 * Controller for letting user creating support tickets. 
 *
 * @author 		Tim Joosten <tim@activisme.be>
 * @copyright	2018 Tim Joosten and contributors
 * @package 	\Misfits\Http\Controllers\Frontend
 */
class HelpdeskController extends Controller
{
	/**
	 * HelpdeskController constructor
	 *
	 * @return void
	 */
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    /**
     * Create view for the user his helpdesk question. 
     *
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
    	return view('frontend.helpdesk.create');
    }

    /**
     * Store method for the user his helpdesk ticket.  
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): RedirectResponse 
    {
    	$input->merge(['create_id' => $input->user()->id]);

    	if ($ticket = $this->helpdesk->create($input->all())) {
    		flash('Your helpdesk ticket has been created.')->success();
    	}

    	return redirect()->route('helpdesk.show', $ticket);
    }

}
