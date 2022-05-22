<?php

namespace App\Http\Controllers;


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
     * This function is called when the class is instantiated. It tells the class to run the
     * middleware function called auth
     */
    public function __construct() {
        $this->middleware('auth');
    }



    /**
     * It takes a `Persona` object as an argument and returns a view called `tutors.show` with the
     * `Persona` object passed to the view as `persona`.
     * 
     * @param Persona persona The model instance passed to the route
     * 
     * @return view tutors.show with the variable persona.
     */
    public function show(Persona $persona) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('tutor', $persona);

        return view('tutors.show', [
            'persona' => $persona,
        ]);
    }

    
    /**
     * Displays the view containing the form for creating a 
     * new tutor.
     * 
     * @param Persona persona is the infant
     */
    public function create(Persona $persona) {
        
        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('create', Persona::class);

        // Obtinc els tutors de l'infant
        $tutors = $persona->infant->tutors;

        // Si l'infant ja té 2 tutors redirigeixo a l'usuari a la ruta infants.index
        if (count($tutors) == 2) {
            return redirect()->route('infants.index')->with('statusTutor', 'ok');
        }

        // Si no obtinc els pobles i mostro el formulari per crear un nou tutor
        $poblacions = Poblacio::get();

        return view('tutors.create', [
            'persona' => new Persona,
            'poblacions' => $poblacions,
            'infant' => $persona
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Persona  $request $excursio instance of the model Excursio
     * @return route tutors.create
     */
    public function store (Persona $persona) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('create', Persona::class);

        $personaInfant = $persona;

        // Comprovo si el tutor exiteix a la base de dades
        $existeixTutor = DB::table('persones as p')->join('tutors as t','p.persona_id','=','t.persona_id')->where('p.dni', request('dni'))->whereNull('p.targeta_sanitaria')->exists();

        // Si es així obtinc el tutor i creo la relació entre l'infant i el tutor en la taula tutors_infants
        if ($existeixTutor == true) {
            $personaTutor = Persona::where('dni', request('dni'))->whereNull('targeta_sanitaria')->first();

            $tutor = $personaTutor->tutor;

            $infantId = $personaInfant->infant->infant_id;

            $tutor->infants()->attach($infantId);

            return redirect()->route('tutors.create', $personaInfant)->with('statusTutor', 'ok');

        // Si no valido les dades introduïdes per l'usuari    
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

            // Creo una nova instància del model Persona amb les dades del tutor i les emmagatzemo a la base de dades
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

            // Creo una nova instància del model Tutor i emmagatzemo les dades a la base de dades
            $tutor = Tutor::create([
                'persona_id' => $persona->persona_id,
            ]);
    
            // Obtinc el id de l'infant passat per paràmetre
            $infantId = $personaInfant->infant->infant_id; 
    
            // Creo la nova relació entre el nou tutor i el infant passat per paràmetre en la taula tutors_infants
            $tutor->infants()->attach($infantId);
    
            // Creo una contrasenya random pel nou tutor
            $password = Str::random(8);
            
            // El rol del tutor sempre serà 2
            $rol = 2;
    
            // Creo una nova instància del model User i emmagatzemo les dades a la base de dades
            User::create([
                'persona_id' => $persona['persona_id'],
                'rol_id' => $rol,
                'user_name' => $persona['dni'],
                'password' => Hash::make($password)
            ]);
            
            // Envio un mail al nou tutor amb les seves dades i la seva contrasenya perquè pugui entrar en el aplicatiu
            Mail::to($persona['email'])->queue(new UserMail($persona, $password)); 
    
            // Redirigeixo a l'usuari a la ruta tutors.create
            return redirect()->route('tutors.create', $personaInfant)->with('statusTutor', 'ok');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Persona $persona instance of the model Persona
     * @return view tutors.edit 
     */
    public function edit(Persona $persona) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('tutor', $persona);

        // Obtinc les poblacions i mostro la vista amb el formulari per editar el tutor
        $poblacions = Poblacio::get();

        return view('tutors.edit', [
            'persona' => $persona,
            'poblacions' => $poblacions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Persona  $persona instance of the model Persona
     * @param  Request $request data entered by the user
     * @return view home / infants.index 
     */
    public function update (Persona $persona, Request $request) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('tutor', $persona);

        // Valido les dades introduïdes per l'usuari
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

        // Actualitzo les dades de la instància persona i les emmagatzemo a la base de dades
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

        // Obtinc la instància user a partir de persona
        $user = $persona->user;

        // Actualitzo les dades de la instància user i les emmagatzemo a la base de dades
        $user->user_name = $request->dni;
        $user->save();

        // Si l'usuari és un tutor el redirigeixo a l'inici i li mostro un missatge per pantalla
        if(auth()->user()->rol_id == 2) {
            return redirect()->route('home')->with('status', "Dades actualitzades correctament");
        }

        // Si l'usuari és un monitor el redirigeixo a la ruta infants.index
        return redirect()->route('infants.index')->with('editatTutor', "Tutor actualitzat correctament");

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Persona  $persona instance of the model Persona
     * @return route infants.index
     */
    public function destroy (Persona $persona) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('monitor', Persona::class);

        // Obtinc les instàncies infant i infantSalut a partir de persona
        $tutor = $persona->tutor;
        $user = $persona->user;
        
        // Elimino les relacions de la taula tutors_infants
        $tutor->infants()->detach();
        // Elimino la instància del model Tutor
        $tutor->delete();
        // Elimino la instància del model user
        $user->delete();
        // Elimino la instància del model Persona
        $persona->delete();
        
        // Redirigeixo a l'usuari a la ruta infants.index
        return redirect()->route('infants.index')->with('statusEliminarTutor','Tutor eliminat correctament.');
    }

    /**
     * It returns a JSON object with the data of the tutor if it exists, or an empty JSON object if it
     * doesn't
     * 
     * @param Request request The request object.
     * 
     * @return json with the tutor's data
     */
    public function existeix (Request $request) {

        $tutor = Persona::where('dni', $request->dni)->whereNull('targeta_sanitaria')->get();

        return response(json_encode($tutor),200)->header('Content-type','text-plain');
    }


    /**
     * If the user is logged in, then get the user's persona, and then authorize the user to change the
     * password.
     * 
     * @return view tutors.change
     */
    public function canviar() {

        // Comprovo que l'usuari estigui autoritzat
        $user = auth()->user();
        $persona = $user->persona;

        $this->authorize('contrasenya', $persona);

        return view('tutors.change');
    }

    /**
     * If the user is authorized to change the password, then validate the request, and if the request
     * is valid, then change the password.
     * 
     * @param Request request The request object.
     * 
     * @return The user's password is being returned.
     */
    public function canviarContrasenya(Request $request) {

        // Comprovo que l'usuari estigui autoritzat
        $user = auth()->user();
        $persona = $user->persona;

        $this->authorize('contrasenya', $persona);

        // Valido les dades introduïdes per les dades
        $this->validate($request, [
            'password' => 'required|min:8|confirmed'
        ]);

        // Obtinc uns instància del model User
        $userBD = $persona->user;

        // Actualitzo la contrasenya i emmagatzemo les dades
        $userBD->password = Hash::make($request->password);
        $userBD->save();

        // Redirigeixo a l'usuari a l'inici i li mostro un missatge per pantalla
        return redirect()->route('home')->with('status', "Contrasenya canviada correctament");
    }
}
