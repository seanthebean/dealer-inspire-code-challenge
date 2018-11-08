<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Jobs\ProcessContactForm;
use App\ContactForm;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexRoute()
    {
        // $request = Request::create('/', 'GET');
        $controller = new HomeController;
        $view = $controller->show();
        $this->assertEquals($view->getName(), 'welcome');
    }

    public function testContactRoute()
    {
        Bus::fake();

        $data = [
            'full_name' => 'Coach Z',
            'email' => 'coach-z@homestarrunner.com',
            'phone' => '123-456-7890',
            'message' => "I'm just me! Can't you see? I'm just a silly little bumblebee!",
        ];
        $request = Request::create('/contact', 'POST', $data);

        $controller = new HomeController;
        $response = $controller->contact($request);

        $this->assertEquals($response->getData()->success, true);

        Bus::assertDispatched(ProcessContactForm::class, function($job) use ($data) {
            return $job->form->full_name == $data['full_name'] &&
                $job->form->email == $data['email'] &&
                $job->form->phone == $data['phone'] &&
                $job->form->message == $data['message'];
        });
    }
}
