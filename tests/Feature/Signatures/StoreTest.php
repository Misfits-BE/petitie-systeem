<?php

namespace Tests\Feature\Signatures;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\InputFakers;
use Misfits\Petition;

/**
 * Class StoreTest 
 * --- 
 * PHPUnit testsuite vor testing the signature store method. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Feature\Signatures
 */
class StoreTest extends TestCase
{
    use RefreshDatabase, InputFakers;

    /**
     * @test
     * @testdox test the validation response (Required)
     */
    public function validationErrorsRequired(): void
    {
        $petition = factory(Petition::class)->create();

        $this->post(route('petition.sign', ['slug' => $petition->slug]), [])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "firstname"  => "The firstname field is required.",
                "lastname"   => "The lastname field is required.",
                "country_id" => "The country id field is required.",
                "city"       => "The city field is required.",
                "email"      => "The email field is required.",
            ]);
    }

    /**
     * @test
     * @testdox test if the signature can be stored successfully
     */
    public function success(): void 
    {
        $input    = $this->fakeSignatureInput();
        $petition = factory(Petition::class)->create();

        $this->post(route('petition.sign', ['slug' => $petition->slug]), $input)
            ->assertStatus(302)
            ->assertRedirect(route('petitions.show', ['slug' => $petition->slug]))
            ->assertSessionHas([
                $this->flashSession . '.level' => 'success', 
                $this->flashSession . '.message' => 'You have signed the petition.'
            ]);

        $this->assertDatabasehas('signatures', $input);
    }
}
