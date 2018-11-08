<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ContactForm;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSave()
    {
        $form = factory(ContactForm::class)->make();
        $data = $form->toArray();
        $form->save();
        $this->assertDatabaseHas('contact_messages', $data);
    }
}
