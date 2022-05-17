<?php

namespace App\Http\Controllers;

use App\Models\Curs;
use App\Models\Grup;
use App\Models\Infant;
use App\Models\Persona;
use App\Models\Poblacio;
use App\Models\InfantSalut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\InfantRequest;

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
    public function index(Request $request)
    {
        $text = $request->search;
        

        if ($text == '') {

            $grups = Grup::get();
            return view('infants.index', compact('grups'));

        } else {

            if (strpos($text, ' ') !== false) {
            
                $split = explode(" ", $text);
                $nom = $split[0];
                $cognoms = $split[1];
    
                $infants = Persona::where('nom', 'LIKE', "%" . $nom . "%")->where('cognoms', 'LIKE', "%" . $cognoms . "%")->whereNotNull('targeta_sanitaria')->get();
                
    
            } else {
                $infants = Persona::where('nom', 'LIKE', "%" . $text . "%")->orwhere('cognoms', 'LIKE',  "%" . $text. "%")->whereNotNull('targeta_sanitaria')->get();
            }

            $grups = [];

            foreach ($infants as $persona) {
                if ($persona->targeta_sanitaria != NULL) {
                    $grups[] = $persona->infant->grup;
                }
                
            }

            if (empty($grups)) {

                return view('infants.index', compact('grups','infants'))->with('statusSearch','ko');
            }

            return view('infants.index', compact('grups','infants'));
        }    

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

        
    

    }

    public function infants(Request $request) {

        if (strpos($request->term, ' ') !== false) {
            
            $split = explode(" ", $request->term);
            $nom = $split[0];
            $cognoms = $split[1];

            $querys = Persona::where('nom', 'LIKE', '%'. $nom . "%")->where('cognoms', 'LIKE', '%' . $cognoms . '%')->whereNotNull('targeta_sanitaria')->get();
            

        } else {
            
            $querys = Persona::where('nom', 'LIKE', '%'. $request->term . "%")->orwhere('cognoms', 'LIKE',  "%" . $request->term . "%")->get();


        }
        

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

    public function update (Persona $persona, Request $request) {

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

        $infant = $persona->infant;
        $infantSalut = $infant->infantSalut;

        $infant->grup_id = $request->grup;
        $infant->curs_id = $request->curs;
        $infant->save();

        if($request['alergies'] == 1) {

            $infantSalut->alergies = $request->alergies;
            $infantSalut->alergia = $request->alergia;

        } else {

            $infantSalut->alergies = $request->alergies;
            $infantSalut->alergia = NULL;
        }   
        
        $infantSalut->save();

        return redirect()->route('infants.index')->with('status', "Infant actualitzat correctament.");
    }


    public function destroy (Persona $persona) {

       $infant = $persona->infant;
       $infantSalut = $infant->infantSalut;

       $infant->tutors()->detach();
       $infantSalut->delete();
       $infant->delete();
       $persona->delete();

       return redirect()->route('infants.index')->with('statusEliminar','Infant eliminat correctament.');
    }
}
