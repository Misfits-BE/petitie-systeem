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
     * @te-stdox
     */
    public function notAuthenticated(): void 
    {

    }

    public function blockedUser(): void 
    {

    }

    public function authenticated(): void 
    {

    }
}
