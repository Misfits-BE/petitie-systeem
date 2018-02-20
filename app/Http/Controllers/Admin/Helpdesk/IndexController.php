<?php

namespace Misfits\Http\Controllers\Admin\Helpdesk;

use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;

/**
 * Class HelpdeskController
 * ---
 * Admin side for the helpdesk module.
 *
 * @todo Create forbid banned user testss
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Admin\Helpdesk
 */
class IndexController extends Controller
{
    /**
     * HelpdeskController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role:admin', 'forbid-banned-user']);
    }

    /**
     * Get the index page for the helpdesk admin.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.helpdesk.index');
    }
}
