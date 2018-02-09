<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisclaimerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 
     * @testdox Test the front-end disclaimer policy page.
     */
    public function disclaimerPolicy()
    {
        $this->get(route('policy.disclaimer'))->assertStatus(200);
    }
}
