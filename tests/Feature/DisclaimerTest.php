<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
