<?php

namespace Tests\Feature\Reports;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;
use Misfits\Petition;

/**
 * Class StoreReportTest 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Reports
 */
class StoreReportTest extends TestCase
{
    use RefreshDatabase, CreatesUsers, InputFakers;

    /**
     * @test
     * @testdox Test if an unauthenticated user can't perform the report store method
     */
    public function unauthenticated(): void 
    {
        $petition = factory(Petition::class)->create();
        $input    = ['subject' => 'subject', 'category' => 'category', 'description' => 'description'];

        $this->post(route('petition.report.store', ['slug' => $petition->slug]), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox test if a banned user can't perform the petition report.
     */
    public function bannedUser(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }

    /**
     * @test 
     * @testdox
     */
    public function validationErrors(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }

    /**
     * @test
     * @testdox
     */
    public function success()
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }
}
