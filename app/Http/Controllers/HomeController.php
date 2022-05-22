<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * The function validates the form data, sends an email and returns a message to the user.
     * 
     * @return The message is being returned to the user.
     */
    public function store () {

        // Valido les dades del formulari de contacte
        $message = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'El camp nom és obligatori.',
            'email.required' => 'El camp email és obligatori.',
            'subject.required' => 'El camp títol és obligatori.',
            'message.required' => 'El camp missatge és obligatori.'
        ]);

        // Envio un correu a l'esplai el pas amb les dades introduides per el convidat
        Mail::to('esplaielpas@gmail.com')->queue(new ContactMail($message)); 

        // Retorno al convidat a l'inici i li mostro un missatge utilizant variables de sessió
        return back()->with('status', 'Hem rebut el teu missatge, respondrem al més aviat possible.');
    }
}
