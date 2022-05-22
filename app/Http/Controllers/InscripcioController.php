<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Excursio;
use App\Models\Inscripcio;
use Illuminate\Http\Request;

class InscripcioController extends Controller
{
    /**
     * This function is called when the class is instantiated. It tells the class to run the
     * middleware function called auth
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
     * It returns a view with a list of children that are registered in the excursion
     * 
     * @param Excursio excursio The excursion that we're looking at.
     * @param Request request The request object.
     * @return view inscripcions.index
     */
    public function index(Excursio $excursio,Request $request)
    {
        // Comprovo que l'usuari estigui autoritzat
        $persona = auth()->user()->persona;

        $this->authorize('monitor', $persona);

        // Si el buscador està buit i les al·lèrgies també mostro un llistat amb tots els infants que estan inscrits a l'excursió separats per grups
        if($request->search == '' && $request->alergies == NULL) {

            $inscripcions = Inscripcio::where('excursio_id', $excursio->excursio_id)->get();

            return view('inscripcions.index', [
                'excursio' => $excursio,
                'grups' => $excursio->grups,
                'inscripcions' => $inscripcions
            ]);

        } else {

            $nomComplet = $request->get('search');
            $alergies = $request->get('alergies');

            // Si el buscador conte un espai busca el nom i cognoms de l'infant inscrit a l'excursió
            if (strpos($nomComplet, ' ') !== false) {

                $split = explode(" ", $nomComplet);
                $nom = $split[0];
                $cognoms = $split[1];

                $infants = Persona::orderBy('persones.persona_id', 'DESC')
                ->nom($nom)
                ->cognoms($cognoms)
                ->inscripcio($excursio->excursio_id)
                ->alergies($alergies)
                ->get();

                // Si el buscador està buit i les al·lèrgies no mostra els infants que tinguin alergies o no i que estiguin inscrits a l'excursió
            } else if ($nomComplet == NULL && $alergies != NULL) {

                $infants = Persona::orderBy('persones.persona_id', 'DESC')
                ->nom($nomComplet)
                ->inscripcio($excursio->excursio_id)
                ->alergies($alergies)
                ->get();

                // Si no obtinc el infant inscrit a l'excursió segons les dades introduïdes per l'usuari
            } else {
                $infants = Persona::orderBy('persones.persona_id', 'DESC')
                ->nom($nomComplet)
                ->inscripcio($excursio->excursio_id)
                ->alergies($alergies)
                ->get();
            } 

            // Obtinc els grups que van d'excursió
            $grupsExcursio = [];

            foreach ($excursio->grups as $grupExcursio) {
                $grupsExcursio[] = $grupExcursio->grup_id;
            }

            // Obtinc els grups dels infants que estan inscrits a l'excursió
            $grups = [];
    
            foreach ($infants as $persona) {
                if ($persona->targeta_sanitaria != NULL) {
                    if(in_array($persona->infant->grup_id, $grupsExcursio)) {
                        if(!in_array($persona->infant->grup, $grups)){
                            $grups[] = $persona->infant->grup;
                        }
                        
                    }
                }
            }

            // Mostro la vista amb els infants inscrits a l'excursió
            return view('inscripcions.index', [
                'excursio' => $excursio,
                'grups' => $grups,
                'infants' => $infants
            ]);
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
     * Show the form for creating a new inscripcio
     * @param  App\Models\Excursio  $excursio instance of the model Excursio
     * @return view inscripcions.create
     */
    public function create(Excursio $excursio)
    {

        // Comprovo que l'usuari estigui autoritzat
        $persona = auth()->user()->persona;

        $this->authorize('inscriure', $persona);

        // Obtinc els grups que poden anar d'excursió
        $grupsExcursio = [];

        foreach ($excursio->grups as $grupExcursio) {
            $grupsExcursio[] = $grupExcursio->grup_id;
        }

        // Obtinc els infants del tutor que puguin anar d'excursió, és a dir, que el seu grup sigui el que vagi d'excursió
        $infants = [];
        $infantsInscrits = 0;
        $infantsInscritsBoolean = false;

        foreach ($persona->tutor->infants as $infant) {

            if (in_array($infant->grup_id, $grupsExcursio)) {

                // Comprovo que els infants no estiguin inscrits ja a l'excursió
                $existeixinscripcio = Inscripcio::where('excursio_id', $excursio->excursio_id)->where('tutor_id', $persona->tutor->tutor_id)->where('infant_id', $infant->infant_id)->exists();

                if (!$existeixinscripcio) {
                    $infants[] = $infant; 
                } else {
                    $infantsInscrits++;
                }       
            }   
        }

        // Comprovo si tots els infants del tutor ja estan inscrits a l'excursió per mostrar un missatge per pantalla a l'usuari
        if ($infantsInscrits == count($persona->tutor->infants)) {
            $infantsInscritsBoolean = true;
        }

        // Retorno la vista inscripcions.create amb l'excursió, el tutor i els infants que poden anar d'excursió
        return view('inscripcions.create', [
            'excursio' => $excursio,
            'persona' => $persona,
            'infants' => $infants,
            'infantsInscritsBoolean' => $infantsInscritsBoolean
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request The request object.
     * @return reoute excursions.index
     */
    public function store(Request $request, Excursio $excursio)
    {

        // Comprovo que l'usuari estigui autoritzat
        $persona = auth()->user()->persona;

        $this->authorize('inscriure', $persona);

        // Valido les dades introduïdes per l'usuari
        $this->validate($request, [
            'infant_id' => 'required',
            'preu' => 'required',
        ]);

        // Creo una instància del model Inscripcio i emmagatzemo les dades a la base de dades
        Inscripcio::create([
            'excursio_id' => $excursio->excursio_id,
            'tutor_id' => $persona->tutor->tutor_id,
            'infant_id' => $request->infant_id,
            'data' => date('Y-m-d H:i:s')
        ]);

        // Redirigeixo a l'usuari a la vista excursions.index
        return redirect()->route('excursions.index')->with('inscripcio', "Infant inscrit a l'excursió");
        
    }
}
