<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
     

        // Return a success response with a session message
        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }
}