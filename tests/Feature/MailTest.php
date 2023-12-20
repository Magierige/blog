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
    //oude test die soortvan werkt
    public function test_mail_send(): void
    {
        $response = $this->get('/send-mail');

        $response->assertStatus(200);

// nieuwe poging

    //     // Set the mail driver to array.
    // Mail::withMailDriver('array', function (Mailer $mailer) {
    //     // ...
    // });

    // // Send the mail.
    // $response = $this->post('/send-mail');

    // // Assert that the mail was sent.
    // $emails = Mail::messages();
    // $this->assertTrue(count($emails) == 1);

    // // Assert that the mail was sent to test@gmail.com.
    // $this->assertEquals('test@gmail.com', $emails[0]->to()[0]);

    // // Restore the mail driver to its original value.
    // Mail::withMailDriver();
    }
}
