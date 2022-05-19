<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcursioRequest;
use App\Models\Grup;
use App\Models\Excursio;
use App\Models\TipoExcursio;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class ExcursioController extends Controller
{

    /**
     * function will apply the auth middleware to all
     * methods in the ProjectController except the index and show methods
     */
    public function __construct() {
        //$this->middleware('auth')->only('create', 'edit'); Si volem fer que pels metodes create i edit l'usuari hagi d'estar autentificat
        $this->middleware('auth'); // S'aplicara el middleware auth (l'usuari haura d'estar autenitificat) a tots els metodes del ProjectController excepte index i show
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('excursions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grups = Grup::get();
        
        $tiposExcursions = TipoExcursio::get();

        return view('excursions.create', [
            'excursio' => new Excursio,
            'tiposExcursions' => $tiposExcursions,
            'grups' => $grups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExcursioRequest $request)
    {
    

        if (!isset($request["grups"])) {
            return redirect()->route('excursions.create')
                ->with(['errorsExcursio' => "La hora d'arribada no pot ser inferior a la hora de sortida!",
                        'nom' => $request->nom,
                        'localitzacio' => $request->localitzacio,
                        'preu' => $request->preu,
                        'lat' => $request->lat,
                        'long' => $request->long,
                        'descripcio' => $request->descripcio]);
        }

        if ($request->data_inici == $request->data_fi) {

            $horaIniciFormulari = explode(':',$request->hora_inici);
            $horaInici = $horaIniciFormulari[0];
            $minutsInici = $horaIniciFormulari[1];

            $horaFiFormulari = explode(':',$request->hora_fi);
            $horaFi = $horaFiFormulari[0];
            $minutsFi = $horaFiFormulari[1];

            
            if ($horaInici > $horaFi) {

                return redirect()->route('excursions.create')
                    ->with(['errorsExcursio' => "La hora d'arribada no pot ser inferior a la hora de sortida!",
                            'nom' => $request->nom,
                            'localitzacio' => $request->localitzacio,
                            'preu' => $request->preu,
                            'lat' => $request->lat,
                            'long' => $request->long,
                            'descripcio' => $request->descripcio]);
            }

            if ($horaInici == $horaFi) {
                if ($minutsInici > $minutsFi) {
                    return redirect()->route('excursions.create')
                        ->with(['errorsExcursio' => "La hora d'arribada no pot ser inferior a la hora de sortida!",
                                'nom' => $request->nom,
                                'localitzacio' => $request->localitzacio,
                                'preu' => $request->preu,
                                'lat' => $request->lat,
                                'long' => $request->long,
                                'descripcio' => $request->descripcio]);
                }
            }
        }

        $imatge = $request->file('imatge');
        $imatge->store('public');

        $autoritzacio = $request->file('autoritzacio');
        $autoritzacio->store('public');

        $excursio = Excursio::create([
            'tipo_excursio_id' => $request->tipo_excursio_id,
            'nom' => $request->nom, 
            'preu'=> $request->preu,
            'descripcio' => $request->descripcio,
            'data_inici' => $request->data_inici . " " . $request->hora_inici,
            'data_fi' => $request->data_fi . " " . $request->hora_fi,
            'localitzacio' => $request->localitzacio,
            'imatge' => $imatge->getClientOriginalName(),
            'autoritzacio' => $autoritzacio->getClientOriginalName(),
            'lat' => $request->lat,
            'long' => $request->long
        ]);
        

        if (count($request["grups"])>0) {

            foreach ($request["grups"] as $grup_id) {
                $excursio->grups()->attach($grup_id);
            }

        }

        return redirect()->route('excursions.index')->with('status', 'Excursió creada amb èxit.');

        //$request->file('imatge')->store('public'); //storage/app/public

        //$imatge = $request->file('imatge') PER OBTENIR LA IMATGE
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
