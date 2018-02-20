<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class StoreTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Users
 */
class StoreTest extends TestCase
{
    /**
     * @test
     * @testdox test if an unauthenticated user can't store a new user
     */
    public function unauthenticated(): void
    {
        //
    }

    /**
     * @test
     * @testdox Test if an user with incorrect permissions can't store a new user
     */
    public function incorrectRole(): void
    {

    }

    /**
     * @test
     * @testdox Test if a user with the correct permission can store a new user
     */
    public function correctRoleSuccess(): void
    {

    }

    /**
     * @test
     * @testdox Test the validation errors when a form incorrect/incomplete is send
     */
    public function correctRoleValidationErrors(): void
    {

    }
}
