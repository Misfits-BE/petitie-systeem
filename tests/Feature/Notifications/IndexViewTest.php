<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class IndexViewTest 
 * ---- 
 * PHPUnit test suite for testing the notifications index page.
 * 
 * @author 
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Notifications
 */
class IndexViewTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    /**
     * @test 
     * @testdox Test the notifations index view when there are no notifications
     */
    public function successNoData(): void 
    {

    }

    /**
     * @test
     * @testdox Test the notifications index page when there are notifications found. 
     */
    public function successWithPagination(): void 
    {

    }

    /**
     * @test
     * @testdox  Test the response when a quest tries to view the notifications index page
     */
    public function unauthenticated(): void 
    {

    }

    /**
     * @test
     * @testdox test the response when a banned user tries to view the notifications index page. 
     */
    public function bannedUser(): void 
    {
        
    }
}
