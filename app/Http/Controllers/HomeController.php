<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function store () {

        $message = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'Falta el teu nom!!!'
        ]);

        // dd($message);

        Mail::to('esplaielpas@gmail.com')->queue(new ContactMail($message)); 

        return back()->with('status', 'Hem rebut el teu missatge, respondrem al més aviat possible.');
    }
}
