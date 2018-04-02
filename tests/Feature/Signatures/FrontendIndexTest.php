<?php

namespace Tests\Feature\Signatures;

use Misfits\Petition;
use Misfits\Signature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class FrontendIndexTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Signatures
 */
class FrontendIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test if a user can view the signature page.
     */
    public function indexTest(): void
    {
        $petition = factory(Petition::class)->create();
        factory(Signature::class)->create(['petition_id' => $petition->id]);

        $this->get(route('petition.signatures', ['slug' => $petition->slug]))
            ->assertStatus(200);
    }
}
