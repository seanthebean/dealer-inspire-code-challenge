<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessContactForm;
use App\ContactForm;

class HomeController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function contact(Request $request)
    {
        // validate request
        $validatedData = $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|phone|max:50', // phone rule is defined in AppServiceProvider.php
            'message' => 'required',
        ]);

        ProcessContactForm::dispatchNow(new ContactForm($validatedData));

        return response()->json([
            'success' => true,
        ]);
    }
}
