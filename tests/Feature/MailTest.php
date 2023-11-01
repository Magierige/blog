<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_mail_send(): void
    {
        $response = $this->get('/send-mail');

        $response->assertStatus(200);
    }
}
