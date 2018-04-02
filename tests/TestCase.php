<?php

namespace Tests;

use Tests\Traits\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Main testcase file for testing 
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Flash session bag. (package: laracasts/flash)
     *
     * @var string $flashSession
     */
    protected $flashSession = 'flash_notification.0';
}
