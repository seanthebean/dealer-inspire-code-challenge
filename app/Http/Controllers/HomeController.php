<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
        return view('welcome');
    }

    public function contact(Request $request) {
        $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|phone|max:50', // phone rule is defined in AppServiceProvider.php
            'message' => 'required',
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
