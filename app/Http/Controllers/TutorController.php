<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorDNIRequest;
use App\Models\Curs;
use App\Models\Grup;
use App\Models\User;
use App\Models\Tutor;
use App\Mail\UserMail;
use App\Models\Persona;
use App\Models\Poblacio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TutorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TutorController extends Controller
{
    public function __construct() {
        //$this->middleware('auth')->only('create', 'edit'); Si volem fer que pels metodes create i edit l'usuari hagi d'estar autentificat
        $this->middleware('auth')->except('index','show'); // S'aplicara el middleware auth (l'usuari haura d'estar autenitificat) a tots els metodes del ProjectController excepte index i show
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $grups = Grup::get();
        return view('tutors.index', compact('grups'));
    

    }

    // MOSTRAR UN INFANT
    public function show() {
        
    }

    /**
     * Per mostrar la vista
     */
    public function create() {
        $infant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();

        $poblacions = Poblacio::get();

        return view('tutors.create', [
            'persona' => new Persona,
            'poblacions' => $poblacions,
            'infant' => $infant
        ]);
    }

    /**
     * Per processar el formulari
     */
    public function store (TutorRequest $request, TutorDNIRequest $requestDNI) {

        $infant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();

        $existeixTutor = DB::table('persones as p')->join('tutors as t','p.persona_id','=','t.persona_id')->where('p.dni', request('dni'))->whereNull('p.targeta_sanitaria')->exists();

        return $existeixTutor;

        if ($existeixTutor == true) {

            return redirect()->route('tutors.create')->with('tutorRegistrat', 'Aquest tutor ja esta registrat!');

        } else {
            $persona = Persona::create($request->validated());

            $tutor = Tutor::create([
                'persona_id' => $persona['persona_id'],
            ]);
    
            $infantId = $infant->infant->infant_id;
    
            $tutor->infants()->attach($infantId);
    
            $password = Str::random(8);
    
            User::create([
                'persona_id' => $persona['persona_id'],
                'user_name' => $persona['dni'],
                'password' => Hash::make($password)
            ]);
            
            Mail::to($persona['email'])->queue(new UserMail($persona, $password)); 
    
            return redirect()->route('tutors.create')->with('statusTutor', 'ok');
        }
    }


    public function edit(Persona $persona) {

        $poblacions = Poblacio::get();

        $cursos = Curs::get();

        $grups = Grup::get();

        return view('infants.edit', [
            'persona' => $persona,
            'poblacions' => $poblacions,
            'cursos' => $cursos,
            'grups' => $grups
        ]);
    }

    public function update (Persona $persona, TutorRequest $request) {

        $persona->update($request->validated());

        $infant = $persona->infant;

        return $infant;

        return redirect()->route('infants.index')->with('status', "Infant actualitzat correctament");
        // validar formulari i fer update infant
    }


    public function destroy () {
       // eliminar infant
    }
}
