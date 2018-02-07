<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Frontend\HelpdeskValidator;

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
     * @param  HelpdeskValidator $input     The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HelpdeskValidator $input): RedirectResponse 
    {
    	$input->merge(['creator_id' => $input->user()->id, 'is_open' => 1]);

    	if ($ticket = $this->helpdesk->create($input->all())) {
    		flash('Your helpdesk ticket has been created.')->success();
    	}

    	return redirect()->route('helpdesk.show', $ticket);
    }
}
