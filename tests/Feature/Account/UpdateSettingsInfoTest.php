<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;
use Tests\Traits\InputFakers;

/**
 * Class UpdateSettingsInfoTest 
 * ---
 * PHPUnit testsuite for checking the account information update routes 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Account
 */
class UpdateSettingsInfoTest extends TestCase
{
    use CreatesUsers, InputFakers, RefreshDatabase;

    /**
     * @test 
     * @testdox Test if a quest can't update profile information in the application. 
     */
    public function notAuthenticated(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }

    /**
     * @test 
     * @testdox Test if a banned user can't update his profile information.
     */
    public function bannedUser(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }

    /**
     * @test 
     * @testdox Test the validation response if a user tries to update his account information. 
     */
    public function validationErrors(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }

    /**
     * @test
     * @testdox Test if a user can update his account information without problems. 
     */
    public function success(): void 
    {
        $this->markTestIncomplete('TODO: Write phpunit test');
    }
}
