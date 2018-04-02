<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class HomeTest 
 * --- 
 * PHPunit test suite for the application front page. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature
 */
class HomeTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test the front-page for the application. 
     */
    public function homePage(): void 
    {
        $this->get(url('/'))->assertStatus(200);
    }
}
