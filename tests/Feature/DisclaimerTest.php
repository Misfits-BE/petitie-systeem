<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * [POLICIES]: Testing the routes to the policy pages.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature
 */
class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Test the front-end disclaimer policy page.
     */
    public function disclaimerPolicy()
    {
        $this->get(route('policy.disclaimer'))->assertStatus(200);
    }
}
