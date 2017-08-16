<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Proyecto;
use App\Meses;

use Session;
use Redirect;
use DB;
use Hash;

class MesesController extends Controller {
    /*public function __construct() {
        $this->middleware('auth');
       $this->middleware('admin');
       $this->middleware('auth', ['only' => 'admin']);
    }*/

    function index() {
        //$meses = Meses::paginate(20);
        $meses=DB::select("SELECT *from proyecto,meses WHERE proyecto.id=meses.idProyecto and meses.deleted_at IS NULL and proyecto.id=".Session::get('idProyecto'));        
        return view('meses.index', compact('meses'));
    }

    public function create() {
        //$proyecto=DB::select("SELECT *from proyecto");        
        return view('meses.create');//,compact('proyecto'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $mes=DB::select('select * from meses where deleted_at IS NULL and idProyecto='.Session::get('idProyecto'));
            if (count($mes) !=0) {
                 $this->destroy($mes[0]->id);
            }
                Meses::create([
                    'mesMin' => $request['mesMin'],          
                    'mesMax' => $request['mesMax'],          

                    'idProyecto' => Session::get('idProyecto'),//$request['idProyecto'],               
                ]);
                DB::commit();                             
                Session::flash('message', 'CREADO CORRECTAMENTE');
                return Redirect::to('/Meses');                    
            }catch (Exception $e) {
                DB::rollback();
                return redirect('/Meses/create')->with("message-error","ERROR INTENTE NUEVAMENTE");      
            }     
    }

    public function edit($id) {
        $meses = Meses::find($id);
        /*echo $meses['idProyecto'];
        $proyecto=DB::select("SELECT *FROM proyecto WHERE proyecto.id=".Session::get('idProyecto')." UNION SELECT *FROM proyecto WHERE proyecto.id!=".Session::get('idProyecto'));   */             
        return view('meses.edit', ['meses' => $meses]);//, compact('proyecto'));
    }

    public function update($id, Request $request) {
        $meses = Meses::find($id);
        $meses->fill($request->all());
        $meses->save();
        Session::flash('message', 'ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('Meses');
    }

    public function destroy($id) {
        $trabajador = Meses::find($id);
        $trabajador->delete();
        Session::flash('message', 'Usuario Eliminado Correctamente');
        return Redirect::to('/mes');
    }

}
