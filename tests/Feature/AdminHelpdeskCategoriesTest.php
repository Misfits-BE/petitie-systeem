<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * [HELPDESK]: Admin categories test case 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature
 */
class AdminHelpdeskCategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function indexUnauthenticated() 
    {

    }

    public function indexWrongRole() 
    {

    }

    public function IndexCorrectRole()
    {

    }
}
