<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Excursio;
use App\Models\TipoExcursio;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use App\Http\Requests\ExcursioRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExcursioEditRequest;

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
    public function index(Request $request)
    {
        
        $grups = Grup::get();
        $tiposExcursions = TipoExcursio::get();


        // $dataActual = date('Y-m-d');
        // $dataActualArray = explode("-", $dataActual);
        // $anyActual = $dataActualArray[0];
        // $mesActual = $dataActualArray[1];
        // $diaActual = $dataActualArray[2];

        
        if ($request->search == '' && $request->grup == NULL && $request->tipoExcursio == NULL) {

            $excursions = Excursio::get();

            // $excursions = Excursio::whereDate('created_at','>',date('Y-m-d'));

            return view('excursions.index', [
                'excursions' => $excursions,
                'grups' => $grups,
                'tiposExcursions' => $tiposExcursions
            ]);

        } else {

            $nom = $request->get('search');
            $grup = $request->get('grup');
            $tipoExcursio = $request->get('tipoExcursio');

            $excursions = Excursio::orderBy('excursions.excursio_id', 'DESC')
                ->nom($nom)
                ->excursio($tipoExcursio)
                ->excursiogrups($grup)
                ->get();


            return view('excursions.index', [
                'excursions' => $excursions,
                'grups' => $grups,
                'tiposExcursions' => $tiposExcursions
            ]);

        }    
    }

    public function excursions(Request $request) {
       
        $querys = Excursio::where('nom', 'LIKE', '%'. $request->term . "%")->get();

        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->nom
            ];
        }

        return $data;
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
                ->with(['errorsExcursio' => "No has seleccionat cap grup perquè vagi d'excursió!",
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

        $imatge = $request->file('imatge')->store('public');
        $imatgeRuta = explode('/', $imatge);
        $imatgeNom = $imatgeRuta[1];

        $autoritzacio = $request->file('autoritzacio')->store('public');
        $autoritzacioRuta = explode('/', $autoritzacio);
        $autoritzacioNom = $autoritzacioRuta[1];

    

        $excursio = Excursio::create([
            'tipo_excursio_id' => $request->tipo_excursio_id,
            'nom' => $request->nom, 
            'preu'=> $request->preu,
            'descripcio' => $request->descripcio,
            'data_inici' => $request->data_inici . " " . $request->hora_inici,
            'data_fi' => $request->data_fi . " " . $request->hora_fi,
            'localitzacio' => $request->localitzacio,
            'imatge' => $imatgeNom,
            'autoritzacio' => $autoritzacioNom,
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
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function show(Excursio $excursio)
    {
        $dataIniciBD = explode(' ',$excursio->data_inici);
        $dataIniciArray = explode('-',$dataIniciBD[0]);
        $dataInici = $dataIniciArray[2] . '/' . $dataIniciArray[1] . "/" . $dataIniciArray[0];

        $horaIniciArray = explode(':',$dataIniciBD[1]);;
        $horaInici = $horaIniciArray[0] . ':' . $horaIniciArray[1];

        $dataFiBD = explode(' ',$excursio->data_fi);
        $dataFiArray = explode('-',$dataFiBD[0]);
        $dataFi = $dataFiArray[2] . '/' . $dataFiArray[1] . "/" . $dataFiArray[0];

        $horaFiArray = explode(':',$dataFiBD[1]);;
        $horaFi = $horaFiArray[0] . ':' . $horaFiArray[1];

        return view('excursions.show', [
            'excursio' => $excursio,
            'dataInici' => $dataInici,
            'horaInici' => $horaInici,
            'dataFi' => $dataFi,
            'horaFi' => $horaFi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Excursio $excursio)
    {
        $dataIniciBD = explode(' ',$excursio->data_inici);
        $dataInici = $dataIniciBD[0];
        $horaInici = $dataIniciBD[1];

        $dataFiBD = explode(' ',$excursio->data_fi);
        $dataFi = $dataFiBD[0];
        $horaFi = $dataFiBD[1];

        $grups = Grup::get();
        $tiposExcursions = TipoExcursio::get();
        $grupsExcursio = [];

        foreach ($excursio->grups as $grupExcursio) {
            $grupsExcursio[] = $grupExcursio->grup_id;
        }

        return view('excursions.edit', [
            'excursio' => $excursio,
            'tiposExcursions' => $tiposExcursions,
            'grups' => $grups,
            'dataInici' => $dataInici,
            'horaInici' => $horaInici,
            'dataFi' => $dataFi,
            'horaFi' => $horaFi,
            'grupsExcursio' => $grupsExcursio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Excursio $excursio, ExcursioEditRequest $request)
    {
        if (!isset($request["grups"])) {
            return redirect()->route('excursions.edit', $excursio)
                ->with(['errorsExcursio' => "No has seleccionat cap grup perquè vagi d'excursió!",
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

                return redirect()->route('excursions.edit', $excursio)
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
                    return redirect()->route('excursions.edit', $excursio)
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

        if ($request->hasFile('imatge')) {
            Storage::delete('public/'.$excursio->imatge);

            $imatge = $request->file('imatge')->store('public');
            $imatgeRuta = explode('/', $imatge);
            $imatgeNom = $imatgeRuta[1];
            $excursio->imatge = $imatgeNom;
        }
        
        if ($request->hasFile('autoritzacio')) {
            Storage::delete('public/'.$excursio->autoritzacio);

            $autoritzacio = $request->file('autoritzacio')->store('public');
            $autoritzacioRuta = explode('/', $autoritzacio);
            $autoritzacioNom = $autoritzacioRuta[1];
            $excursio->autoritzacio = $autoritzacioNom;
        }    


        $excursio->tipo_excursio_id = $request->tipo_excursio_id;
        $excursio->nom = $request->nom;
        $excursio->preu = $request->preu;
        $excursio->descripcio = $request->descripcio;
        $excursio->data_inici = $request->data_inici . " " . $request->hora_inici;
        $excursio->data_fi = $request->data_fi . " " . $request->hora_fi;
        $excursio->localitzacio = $request->localitzacio;
        $excursio->lat = $request->lat;
        $excursio->long = $request->long;
        $excursio->save();

        $grupsExcursio = [];

        foreach ($request->grups as $grup_id) {
            $grupsExcursio[] = $grup_id;
        }

      
        $excursio->grups()->sync($grupsExcursio);
           


        return redirect()->route('excursions.index')->with('status', 'Excursió actualitzada amb èxit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Excursio $excursio)
    {
        Storage::delete('public/'.$excursio->imatge);
        Storage::delete('public/'.$excursio->autoritzacio);

        $excursio->grups()->detach();
        $excursio->delete();

        return redirect()->route('excursions.index')->with('status','Excursió eliminada amb èxit.');
    }
}
