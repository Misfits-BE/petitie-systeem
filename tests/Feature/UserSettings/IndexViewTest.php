<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class IndexViewTest
 * -----
 * Testcase for the user settings view. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\UserSettings
 */
class IndexViewTest extends TestCase
{
    /**
     * @test
     * @testdox
     */
    public function notAuthenticated(): void 
    {

    }

    /**
     * @test 
     * @testdox
     */
    public function blockedUser(): void 
    {

    }

    /**
     * @test 
     * @testdox
     */
    public function authenticated(): void 
    {

    }
}
