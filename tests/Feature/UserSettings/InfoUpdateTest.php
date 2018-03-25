<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class InfoUpdateTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\UserSettings
 */
class InfoUpdateTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    public function unauthenticated(): void
    {

    }

    public function authenticated(): void
    {

    }

    public function blockedUsers(): void
    {

    }

    public function validationNameRequired(): void
    {

    }

    public function validationNameString(): void
    {

    }

    public function validationNameMax(): void
    {

    }

    public function validationEmailRequired(): void
    {

    }

    public function validationEmailString(): void
    {

    }

    /**
     * @test
     * @testdox Test the validation for checking of the given email field is effective an email address
     *
     * @group account-settings
     */
    public function validationEmailEmail(): void
    {

    }

    public function validationEmailMax(): void
    {

    }

    public function validationEmailUnique(): void
    {

    }
}
