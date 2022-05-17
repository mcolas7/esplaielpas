<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\User;
use App\Models\Tutor;
use App\Mail\UserMail;
use App\Models\Persona;
use App\Models\Poblacio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * Display a listing of the resource. It gets all the groups from the database and passes them to the view.
     * 
     * @return The view 'infants.index' with the variable 'grups'
     */
    public function index()
    {
        $grups = Grup::get();
        return view('infants.index', compact('grups'));
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

    
    /**
     * It creates a new tutor for an infant. Displays the view containing the form for creating a 
     * new tutor.
     * 
     * @param Persona persona is the infant
     */
    public function create(Persona $persona) {
        
        //$infant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();
        

        $tutors = $persona->infant->tutors;

        if (count($tutors) == 2) {
            return redirect()->route('infants.index')->with('statusTutor', 'ok');
        }

        $poblacions = Poblacio::get();

        return view('tutors.create', [
            'persona' => new Persona,
            'poblacions' => $poblacions,
            'infant' => $persona
        ]);
    }

    

    /**
     * Per processar el formulari
     */
    public function store (Persona $persona) { // TutorRequest $request

        //$personaInfant = Persona::latest()->whereNotNull('targeta_sanitaria')->first();

        $personaInfant = $persona;

        $existeixTutor = DB::table('persones as p')->join('tutors as t','p.persona_id','=','t.persona_id')->where('p.dni', request('dni'))->whereNull('p.targeta_sanitaria')->exists();

        if ($existeixTutor == true) {
            $personaTutor = Persona::where('dni', request('dni'))->whereNull('targeta_sanitaria')->first();

            $tutor = $personaTutor->tutor;

            $infantId = $personaInfant->infant->infant_id; //$infantId = $personaInfant->infant->infant_id;

            $tutor->infants()->attach($infantId);

            return redirect()->route('tutors.create', $personaInfant)->with('statusTutor', 'ok');

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
    
            $infantId = $personaInfant->infant->infant_id; //$infantId = $personaInfant->infant->infant_id;
    
            $tutor->infants()->attach($infantId);
    
            $password = Str::random(8);
    
            User::create([
                'persona_id' => $persona['persona_id'],
                'user_name' => $persona['dni'],
                'password' => Hash::make($password)
            ]);
            
            Mail::to($persona['email'])->queue(new UserMail($persona, $password)); 
    
            return redirect()->route('tutors.create', $personaInfant)->with('statusTutor', 'ok');
        }
    }


    public function edit(Persona $persona) {

        $poblacions = Poblacio::get();

        return view('tutors.edit', [
            'persona' => $persona,
            'poblacions' => $poblacions
        ]);
    }

    public function update (Persona $persona, Request $request) {


        $this->validate($request, [
            'nom' => 'required',
            'cognoms' => 'required',
            'email' => 'required|email',
            'telefon' => 'required|min:9|max:9|digits:9',
            'data_naixement' => 'required',
            'carrer' => 'required',
            'poblacio_id' => 'required',
            'codi_postal' => 'required|min:5|max:5|digits:5',
            'dni' => 'nullable|unique:persones,dni,'.$persona->persona_id.',persona_id'
        ],[
            'dni.unique' => 'El DNI ja està registrat i no es pot repetir.'
        ]);

        $persona->poblacio_id = $request->poblacio_id; 
        $persona->nom = $request->nom;
        $persona->cognoms = $request->cognoms;
        $persona->email = $request->email;
        $persona->telefon = $request->telefon;
        $persona->carrer = $request->carrer;
        $persona->codi_postal = $request->codi_postal;
        $persona->data_naixement = $request->data_naixement;
        $persona->dni = $request->dni;
        $persona->save();

        $user = $persona->user;

        $user->user_name = $request->dni;
        $user->save();

        return redirect()->route('infants.index')->with('editatTutor', "Tutor actualitzat correctament");

    }


    public function destroy (Persona $persona) {

        $tutor = $persona->tutor;
        $user = $persona->user;
        
        $tutor->infants()->detach();

        $tutor->delete();
        $user->delete();
        $persona->delete();
        
        return redirect()->route('infants.index')->with('statusEliminarTutor','Tutor eliminat correctament.');
    }

    public function existeix (Request $request) {

        $tutor = Persona::where('dni', $request->dni)->whereNull('targeta_sanitaria')->get();

        return response(json_encode($tutor),200)->header('Content-type','text-plain');
    }
}
