<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistratieTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    use RefreshDatabase;

    public function test_registration_page_exists(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
    public function test_registration_process_works() : void
    {
        $response = $this->post('/register', [
            'name' => 'registratie test',
            'email' => 'registratie@test.nl',
            'password' => 'Admin666',
            'password_confirmation' => 'Admin666',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'registratie test',
            'email' => 'registratie@test.nl',
        ]);
    }
}
