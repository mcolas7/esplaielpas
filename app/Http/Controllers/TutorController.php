<?php

namespace App\Http\Controllers;

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
    /**
     * function will apply the auth middleware to all
     * methods in the ProjectController except the index and show methods
     */
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

    /**
     * It takes a `Persona` object as an argument and returns a view called `tutors.show` with the
     * `Persona` object passed to the view as `persona`.
     * 
     * @param Persona persona The model instance passed to the route
     * 
     * @return The view tutors.show with the variable persona.
     */
    public function show(Persona $persona) {
        return view('tutors.show', [
            'persona' => $persona,
        ]);
    }

    /**
     * Per mostrar la vista
     */
    public function create() {

        $infant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();

        $tutors = $infant->infant->tutors;

        if (count($tutors) == 2) {
            return redirect()->route('infants.index')->with('statusTutor', 'ok');
        }

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
    public function store () { // TutorRequest $request

        $personaInfant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();

        $existeixTutor = DB::table('persones as p')->join('tutors as t','p.persona_id','=','t.persona_id')->where('p.dni', request('dni'))->whereNull('p.targeta_sanitaria')->exists();

        if ($existeixTutor == true) {
            $personaTutor = Persona::where('dni', request('dni'))->whereNull('targeta_sanitaria')->first();

            $tutor = $personaTutor->tutor;

            $infantId = $personaInfant->infant->infant_id;

            $tutor->infants()->attach($infantId);

            return redirect()->route('tutors.create')->with('statusTutor', 'ok');

        } else {

            $formulari = request()->validate([
                'nom' => 'required',
                'cognoms' => 'required',
                'email' => 'required|email',
                'telefon' => 'required|min:9|max:9|digits:9',
                'data_naixement' => 'required',
                'dni' => 'required|unique:persones',
                'carrer' => 'required',
                'poblacio_id' => 'required',
                'codi_postal' => 'required|min:5|max:5|digits:5',
            ], [
                'dni.unique' => 'El DNI ja està registrat i no es pot repetir.'
            ]);

            $persona = Persona::create([
                'poblacio_id' => $formulari['poblacio_id'],
                'nom' => $formulari['nom'], 
                'cognoms'=> $formulari['cognoms'],
                'email'=> $formulari['email'],
                'telefon'=> $formulari['telefon'],
                'carrer'=> $formulari['carrer'],
                'codi_postal' => $formulari['codi_postal'],
                'data_naixement' => $formulari['data_naixement'],
                'dni' => $formulari['dni']
            ]);

            $tutor = Tutor::create([
                'persona_id' => $persona->persona_id,
            ]);
    
            $infantId = $personaInfant->infant->infant_id;
    
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

    public function existeix (Request $request) {

        $tutor = Persona::where('dni', $request->dni)->whereNull('targeta_sanitaria')->get();

        return response(json_encode($tutor),200)->header('Content-type','text-plain');
    }
}
