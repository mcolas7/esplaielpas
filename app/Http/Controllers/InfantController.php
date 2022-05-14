<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfantRequest;
use App\Models\Curs;
use App\Models\Grup;
use App\Models\Infant;
use App\Models\InfantSalut;
use App\Models\Persona;
use App\Models\Poblacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfantController extends Controller
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

        // if (request('buscar') == NULL) {

            
        // } else {

        // $id = 6;
        // $grup = Grup::find($id);
        // $espurnes = $grup->infants;

        // foreach ($espurnes as $espurna) {
        //     return $espurna->persona['nom'];
        // }
        // $infantsEspurnes = $espurnes->persona;

        // return $infantsEspurnes;

        // $id = 1;
        // $infant = Infant::find($id);

        //return $infant->grup;

        // return view('infants.index', [
        //     'espurnes' => $espurnes
        // ]);

        $grups = Grup::get();
        return view('infants.index', compact('grups'));
    

    }

    public function infants(Request $request) {

        if (strpos($request->term, ' ') !== false) {
            
            $split = explode(" ", $request->term);
            $nom = $split[0];
            $cognoms = $split[1];

            $querys = Persona::where('nom', 'LIKE', '%'. $nom . "%")->where('cognoms', 'LIKE', '%' . $cognoms . '%')->whereNotNull('targeta_sanitaria')->get();
            

        } else {
            $querys = Persona::where('nom', 'LIKE', '%'. $request->term . "%")->whereNotNull('targeta_sanitaria')->get();
        }

        // si $request->term conte un espai fer consulta per nom i cognoms

        

        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->nom . " " . $query->cognoms
            ];
        }

        return $data;
    }

    // MOSTRAR UN INFANT
    public function show(Persona $persona) {
        return view('infants.show', [
            'persona' => $persona,
        ]);
    }

    /**
     * Per mostrar la vista
     */
    public function create() {

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
     * Per processar el formulari
     */
    public function store (InfantRequest $request) {

        // NO FA FALTA PERQUE VALIDEM LES DADES AL InfantRequest -------------------------------------------------------------- BORRAAAAR!!
        // $formulari = request()->validate([
        //     'nom' => 'required',
        //     'cognoms' => 'required',
        //     'email' => 'required|email',
        //     'telefon' => 'required|min:9|max:9',
        //     'data_naixement' => 'required',
        //     'curs' => 'required',
        //     'grup' => 'required',
        //     'targeta_sanitaria' => 'required',
        //     'carrer' => 'required',
        //     'poblacio' => 'required',
        //     'codi_postal' => 'required|min:5|max:5',
        //     'dni' => '',
        //     'alergies' => 'required',
        //     'alergia' => ''
        // ], [
        //     'nom.required' => 'Introdueix el nom!!!!'
        // ]); -------------------------------------------------------------------------------------------- BORRAR FINS AQUI

        // $existeixRegistre = DB::table('persones')->where('targeta_sanitaria', request('targeta_sanitaria'))->exists(); HO FAIG PER COMPROVAR SI LA TARGETA SANITARIA EXISTEIX

        // if ($existeixRegistre == false) {

            
            Persona::create($request->validated());
           
            

            // ES EL MATEIX QUE FER AIXO -------------------------------------------------------------- BORRAAAAR!!
            // if (is_null(request('dni'))) { // $formulari['dni']
            //     Persona::create([
            //         'poblacio_id' => request('poblacio'),
            //         'nom' => request('nom'), 
            //         'cognoms'=> request('cognoms'),
            //         'email'=> request('email'),
            //         'telefon'=> request('telefon'),
            //         'carrer'=> request('carrer'),
            //         'codi_postal' => request('codi_postal'),
            //         'data_naixement' => request('data_naixement'),
            //         'targeta_sanitaria' => request('targeta_sanitaria')
            //     ]);
                
            // } else {
    
            //     Persona::create([
            //         'poblacio_id' => request('poblacio'),
            //         'nom' => request('nom'), 
            //         'cognoms'=> request('cognoms'),
            //         'email'=> request('email'),
            //         'telefon'=> request('telefon'),
            //         'carrer'=> request('carrer'),
            //         'codi_postal' => request('codi_postal'),
            //         'data_naixement' => request('data_naixement'),
            //         'dni' => request('dni'),
            //         'targeta_sanitaria' => request('targeta_sanitaria')
            //     ]);
                
            // } -------------------------------------------------------------------------------------------- BORRAR FINS AQUI
    
            $personaId = Persona::latest()->first();
    
            Infant::create([
                'persona_id' => $personaId['persona_id'],
                'grup_id' => request('grup'),
                'curs_id' => request('curs')
            ]);

            $infantId = Infant::latest()->first();

            if($request['alergies'] == 1) {

                InfantSalut::create([
                    'infant_id' => $infantId['infant_id'],
                    'alergies' => request('alergies'),
                    'alergia' => request('alergia')
                ]);

            } else {

                InfantSalut::create([
                    'infant_id' => $infantId['infant_id'],
                    'alergies' => request('alergies')
                ]);
            }    
            

            return redirect()->route('tutors.create')->with('statusInfant', 'ok'); // Metode with() per enviar a la vista variables de sessio que duraran fins que l'usuari recarregui la pagina

        // } else {
            
        //     return back()->with('message', 'Aquest infant ja exiteix a la base de dades!');

        // }

    
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

    public function update (Persona $persona, InfantRequest $request) {

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
