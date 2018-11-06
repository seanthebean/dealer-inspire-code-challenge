<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show() {
        return view('welcome');
    }

    public function contact(Request $request) {
        // validate request
        $validatedData = $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|phone|max:50', // phone rule is defined in AppServiceProvider.php
            'message' => 'required',
        ]);

        // email guy smiley

        // store in DB
        DB::table('messages')
            ->insert([
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'message' => $validatedData['message'],
            ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
