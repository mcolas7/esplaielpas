<?php

namespace App\Http\Controllers;


use App\Models\Curs;
use App\Models\Grup;
use App\Models\Infant;
use App\Models\Persona;
use App\Models\Poblacio;
use App\Models\InfantSalut;
use Illuminate\Http\Request;
use App\Http\Requests\InfantRequest;

class InfantController extends Controller
{
    /**
     * This function is called when the class is instantiated. It tells the class to run the
     * middleware function called auth
     */
    public function __construct() {
        $this->middleware('auth'); 
    }

    
    /**
     * If the search field is empty, it returns all the groups. If it's not empty, it returns the
     * groups that contain the searched text
     * 
     * @param Request request The request object
     * @return view infants.index
     */
    public function index(Request $request)
    {
        // Comprovo que l'usuari estigui autoritzat a veure el llistat d'infants
        $this->authorize('monitor', Persona::class);


        $text = $request->search;
        
        // Si el buscador està buit obtinc tots els grups i mostro el llistat d'infants separats per grups
        if ($text == '') {

            $grups = Grup::get();
            return view('infants.index', compact('grups'));

        // Si no busco el nom o cognoms introduït per l'usuari a la base de dades    
        } else {

            // Si conté un espai busco nom i cognoms
            if (strpos($text, ' ') !== false) {
            
                $split = explode(" ", $text);
                $nom = $split[0];
                $cognoms = $split[1];
    
                $infants = Persona::where('nom', 'LIKE', "%" . $nom . "%")->where('cognoms', 'LIKE', "%" . $cognoms . "%")->whereNotNull('targeta_sanitaria')->get();
                
            // Si o busco el nom o el cognom
            } else {
                $infants = Persona::where('nom', 'LIKE', "%" . $text . "%")->orwhere('cognoms', 'LIKE',  "%" . $text. "%")->whereNotNull('targeta_sanitaria')->get();
            }

            // Obtinc el grup o els grups al qual pertany l'infant
            $grups = [];
            foreach ($infants as $persona) {
                if ($persona->targeta_sanitaria != NULL) {
                    if (!in_array($persona->infant->grup, $grups)) {
                        $grups[] = $persona->infant->grup;
                    }
                }
            }

            // Si l'array de grups esta buit significa que no ha trobat cap infant així que li mostro un missatge a l'usuari
            if (empty($grups)) {

                return view('infants.index', compact('grups','infants'))->with('statusSearch','ko');
            }

            // Si no retorno la vista amb els grups i els infants
            return view('infants.index', compact('grups','infants'));
        }    
    }


    /**
     * It searches for a person in the database and returns the first 5 results.
     * 
     * @param Request request The request object.
     * 
     * @return data matches from database
     */
    public function infants(Request $request) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('monitor', Persona::class);

        // Realitzo la busqueda a la base de dades segons el text introduït per l'usuari
        if (strpos($request->term, ' ') !== false) {
            
            $split = explode(" ", $request->term);
            $nom = $split[0];
            $cognoms = $split[1];

            $querys = Persona::where('nom', 'LIKE', '%'. $nom . "%")->where('cognoms', 'LIKE', '%' . $cognoms . '%')->whereNotNull('targeta_sanitaria')->get();
            
        } else {
            
            $querys = Persona::where('nom', 'LIKE', '%'. $request->term . "%")->orwhere('cognoms', 'LIKE',  "%" . $request->term . "%")->get();

        }

        // Afeigeixo el nom i cognoms de l'infant a l'array data
        $data = [];

        foreach ($querys as $query) {

            if ($query->targeta_sanitaria != NULL) {
                $data[] = [
                    'label' => $query->nom . " " . $query->cognoms
                ];
            }

            if (sizeof($data) > 4) {
                break;
            }
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Persona $persona instance of the model Persona
     * @return view infants.show
     */
    public function show(Persona $persona) {

        // Primer comprovo si l'usuari esta autoritzat i després mostro les dades de l'infant
        $this->authorize('show', $persona);

        return view('infants.show', [
            'persona' => $persona,
        ]);
    }

    /**
     * Show the form for creating a new infant.
     * @return view infants.create
     */
    public function create() {

        // Primer comprovo si l'usuari esta autoritzat i després mostro el formulari per crear un nou infant
        $this->authorize('create', Persona::class);

        $poblacions = Poblacio::get();

        $cursos = Curs::get();

        $grups = Grup::get();

        return view('infants.create', [
            'persona' => new Persona,
            'poblacions' => $poblacions,
            'cursos' => $cursos,
            'grups' => $grups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\InfantRequest  $request validates the data entered by the user
     * @return route tutors.create
     */
    public function store (InfantRequest $request) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('create', Persona::class);
        
        // Creo una nova instància del model Persona i emmagatzemo les dades a la base de dades
        $persona = Persona::create($request->validated());
    
        // Creo una nova instància del model Infant i emmagatzemo les dades a la base de dades
        $infant = Infant::create([
            'persona_id' => $persona->persona_id,
            'grup_id' => request('grup'),
            'curs_id' => request('curs')
        ]);

        // Comprovo si l'infant té al·lèergies i creo una nova instància del model InfantSalut i emmagatzemo les dades a la base de dades
        if($request['alergies'] == 1) {

            InfantSalut::create([
                'infant_id' => $infant->infant_id,
                'alergies' => request('alergies'),
                'alergia' => request('alergia')
            ]);

        } else {

            InfantSalut::create([
                'infant_id' => $infant->infant_id,
                'alergies' => request('alergies')
            ]);
        }    
            
        // Redirigeixo al monitor a la ruta tutors.create perque m'afegeixi un tutor i li passo per paràmetre l'infant
        return redirect()->route('tutors.create', $persona)->with('statusInfant', 'ok');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Persona $persona instance of the model Persona
     * @return view infants.edit 
     */
    public function edit(Persona $persona) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('update', $persona);

        // Obtinc les poblacions, cursos i grups
        $poblacions = Poblacio::get();

        $cursos = Curs::get();

        $grups = Grup::get();

        // Mostro la vista infants.edit
        return view('infants.edit', [
            'persona' => $persona,
            'poblacions' => $poblacions,
            'cursos' => $cursos,
            'grups' => $grups
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Persona  $persona instance of the model Persona
     * @param  Request $request data entered by the user
     * @return view excursions.index 
     */
    public function update (Persona $persona, Request $request) {

        // Comprovo que l'usuari estigui autoritzat
        $this->authorize('update', $persona);

        // Valido les dades introduïdes per l'usuari
        $this->validate($request, [
            'nom' => 'required',
            'cognoms' => 'required',
            'email' => 'required|email',
            'telefon' => 'required|min:9|max:9|digits:9',
            'data_naixement' => 'required',
            'curs' => 'required',
            'grup' => 'required',
            'targeta_sanitaria' => 'required|unique:persones,targeta_sanitaria,'.$persona->persona_id.',persona_id',
            'carrer' => 'required',
            'poblacio_id' => 'required',
            'codi_postal' => 'required|min:5|max:5|digits:5',
            'dni' => 'nullable|unique:persones,dni,'.$persona->persona_id.',persona_id',
            'alergies' => 'required',
            'alergia' => ''
        ],[
            'targeta_sanitaria.unique' => 'La targeta sanitària ja està registrada i no es pot repetir.',
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
        $persona->targeta_sanitaria = $request->targeta_sanitaria;
        $persona->save();

        // Obtinc les instàncies infant i infantSalut a partir de persona
        $infant = $persona->infant;
        $infantSalut = $infant->infantSalut;

        // Actualitzo les dades de la instància infant i les emmagatzemo a la base de dades
        $infant->grup_id = $request->grup;
        $infant->curs_id = $request->curs;
        $infant->save();

        // Actualitzo les dades de la instància infantSalut i les emmagatzemo a la base de dades
        if($request['alergies'] == 1) {

            $infantSalut->alergies = $request->alergies;
            $infantSalut->alergia = $request->alergia;

        } else {

            $infantSalut->alergies = $request->alergies;
            $infantSalut->alergia = NULL;
        }   
        
        $infantSalut->save();

        // Redirigeixo a l'usuari a la ruta infants.index
        return redirect()->route('infants.index')->with('status', "Infant actualitzat correctament.");
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
        $infant = $persona->infant;
        $infantSalut = $infant->infantSalut;

        // Elimino les relacions de la taula tutors_infants
        $infant->tutors()->detach();
        // Elimino la instància del model InfantSalut
        $infantSalut->delete();
        // Elimino la instància del model Infant
        $infant->delete();
        // Elimino la instància del model Persona
        $persona->delete();

        // Redirigeixo a l'usuari a la ruta infants.index
        return redirect()->route('infants.index')->with('statusEliminar','Infant eliminat correctament.');
    }
}
