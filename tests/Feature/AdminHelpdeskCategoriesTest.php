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

    /**
     * @test
     * @testdox Test if an unauthenticated user doàesn't have access to the helpdesk admin section
     */
    public function indexUnauthenticated() 
    {

    }

    /**
     * @test
     * @testdox Test if an user with the correct role can view the helpdesk categories
     */
    public function indexWrongRole() 
    {

    }

    /**
     * @test
     * @testdox Test if an user with an incorrect doesn't have access to the helpdesk categories admin
     */
    public function indexCorrectRole()
    {

    }
}
