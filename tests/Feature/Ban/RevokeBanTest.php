<?php

namespace Tests\Feature\Ban;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CreatesUsers;

/**
 * Class: RevokeBanTest 
 * 
 * @license
 * @copyright
 * @package 
 */
class RevokeBanTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;
}
