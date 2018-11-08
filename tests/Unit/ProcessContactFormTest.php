<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessContactForm;
use App\Mail\ContactMessage;
use App\ContactForm;

class ProcessContactFormTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHandle()
    {
        Mail::fake();

        $form = $this->createMock(ContactForm::class);
        $form->method('save')
             ->will($this->returnSelf());

        $job = new ProcessContactForm($form);
        $result = $job->handle();

        Mail::assertSent(ContactMessage::class, function ($mail) {
            return $mail->hasTo('guy-smiley@example.com');
        });
        $this->assertEquals($result, true);
    }
}
