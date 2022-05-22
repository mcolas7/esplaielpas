<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Excursio;
use App\Models\TipoExcursio;
use Illuminate\Http\Request;
use App\Http\Requests\ExcursioRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExcursioEditRequest;

class ExcursioController extends Controller
{

    /**
     * This function is called when the class is instantiated. It tells the class to run the
     * middleware function called auth
     */
    public function __construct() {
        $this->middleware('auth');
    }



    
    /**
     * A function that returns a view with the excursions, groups and types of excursions.
     * 
     * @param Request request The request object.
     * @return view excursions.index
     */
    public function index(Request $request)
    {
        
        $grups = Grup::get();
        $tiposExcursions = TipoExcursio::get();
        
        // Si no han buscat res pel buscador mostro totes les excursions
        if ($request->search == '' && $request->grup == NULL && $request->tipoExcursio == NULL) {

            $excursions = Excursio::get();

            return view('excursions.index', [
                'excursions' => $excursions,
                'grups' => $grups,
                'tiposExcursions' => $tiposExcursions
            ]);

        // Si no filtro segons els inputs de l'usuari
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

    /**
     * It takes the input from the search bar, and searches the database for any matches
     * 
     * @param Request request The request object.
     * @return data matches from database
     */
    public function excursions(Request $request) {
       
        // Pregunto a la base de dades si exiteix una excursió amb el nom escrit per l'usuari
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
     * Show the form for creating a new excursio.
     * @return view excursions.create
     */
    public function create()
    {
        // Primer comprovo si l'usuari esta autoritzat i després mostro el formulari per crear una nova excursió
        $this->authorize('monitor', Persona::class);

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
     * @param  App\Http\Requests\ExcursioRequest  $request validates the data entered by the user
     * @return route excursions.index
     */
    public function store(ExcursioRequest $request) 
    {

        // Valido que l'usuari estigui autoritzat en crear una nova excursió
        $this->authorize('monitor', Persona::class);

        // Comprovo que com a minim el monitor hagi seleccionat un grup per anar d'excursió
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

        // Comprovo que si la data d'inici de l'excursió és igual a la data de fi l'hora de sortida sigui més gran que l'hora d'arribada
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

        // Emmagatzemo la imatge i l'autorització a la carpeta storage\app\public
        $imatge = $request->file('imatge')->store('public');
        $imatgeRuta = explode('/', $imatge);
        $imatgeNom = $imatgeRuta[1];

        $autoritzacio = $request->file('autoritzacio')->store('public');
        $autoritzacioRuta = explode('/', $autoritzacio);
        $autoritzacioNom = $autoritzacioRuta[1];

    
        // Emmagatzemo la nova excursió a la base de dades
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
        
        // Emmagatzemo les relacions de la taula excursions_grups
        if (count($request["grups"])>0) {

            foreach ($request["grups"] as $grup_id) {
                $excursio->grups()->attach($grup_id);
            }

        }

        return redirect()->route('excursions.index')->with('status', 'Excursió creada amb èxit.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Excursio $excursio instance of the model Excursio
     * @return view excursions.show
     */
    public function show(Excursio $excursio)
    {
        // Dono format a les dates i retorno la vista passant per paràmetre la instància del model Excursio
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
     * @param  App\Models\Excursio $excursio instance of the model Excursio
     * @return view excursions.edit 
     */
    public function edit(Excursio $excursio)
    {
        // Comprovo que l'usuari estigui autoritzat per editar una excursió
        $this->authorize('monitor', Persona::class);

        // Dono format a les dates, obtinc els grups que van d'excursió i el tipos d'excursió
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

        // Retorno el formulari amb la vista perquè l'usuari pugui editar les dades de l'excursió
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
     * @param  App\Models\Excursio  $excursio instance of the model Excursio
     * @param  App\Http\Requests\ExcursioEditRequest $request validates the data entered by the user
     * @return view excursions.index 
     */
    public function update(Excursio $excursio, ExcursioEditRequest $request)
    {
        // Comprovo que l'usuari estigui autoritzat per editar una excursió
        $this->authorize('monitor', Persona::class);

        // Comprovo que com a minim el monitor hagi seleccionat un grup per anar d'excursió
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

        // Comprovo que si la data d'inici de l'excursió és igual a la data de fi l'hora de sortida sigui més gran que l'hora d'arribada
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

        // Si el monitor afegeix una nova imatge elimino l'antiga i emmagatzemo la nova
        if ($request->hasFile('imatge')) {
            Storage::delete('public/'.$excursio->imatge);

            $imatge = $request->file('imatge')->store('public');
            $imatgeRuta = explode('/', $imatge);
            $imatgeNom = $imatgeRuta[1];
            $excursio->imatge = $imatgeNom;
        }
        
        // Si el monitor afegeix una nova autorització elimino l'antiga i emmagatzemo la nova
        if ($request->hasFile('autoritzacio')) {
            Storage::delete('public/'.$excursio->autoritzacio);

            $autoritzacio = $request->file('autoritzacio')->store('public');
            $autoritzacioRuta = explode('/', $autoritzacio);
            $autoritzacioNom = $autoritzacioRuta[1];
            $excursio->autoritzacio = $autoritzacioNom;
        }    

        // Actualitzo les dades de l'excursió
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

        // Obtinc els grups que van d'excursió
        $grupsExcursio = [];

        foreach ($request->grups as $grup_id) {
            $grupsExcursio[] = $grup_id;
        }

        // Actualitzo les relacions de la taula excursions_grups
        $excursio->grups()->sync($grupsExcursio);
           

        // Redirigeixo a l'usuari a la ruta excursions.index
        return redirect()->route('excursions.index')->with('status', 'Excursió actualitzada amb èxit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Excursio  $excursio instance of the model Excursio
     * @return route excursions.index
     */
    public function destroy(Excursio $excursio)
    {
        // Comprovo que l'usuari estigui autoritzat per editar una excursió
        $this->authorize('monitor', Persona::class);

        // Elimino la imatge i l'autorització de l'excursió
        Storage::delete('public/'.$excursio->imatge);
        Storage::delete('public/'.$excursio->autoritzacio);

        // Elimino les relacions de la taula excursions_grups
        $excursio->grups()->detach();

        // Elimino l'excursió
        $excursio->delete();

        // Redirigeixo a l'usuari a la ruta excursions.index
        return redirect()->route('excursions.index')->with('status','Excursió eliminada amb èxit.');
    }
}
