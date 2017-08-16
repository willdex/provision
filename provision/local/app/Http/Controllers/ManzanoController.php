<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Session;
use Redirect;
use App\Manzano;
use App\Proyecto;
use DB;
use Hash;

class ManzanoController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//        $this->middleware('admin');
//        $this->middleware('auth', ['only' => 'admin']);
    }

    function index() {
        $manzano=DB::table('manzano')
        ->join('proyecto','proyecto.id','=','manzano.id_proyecto')
        ->select('manzano.*', 'proyecto.nombre as nombre_pro')
        ->paginate(20);

        $proyectos=Proyecto::lists('nombre','id');
        return view('manzano.index',["manzano"=>$manzano],  compact('proyectos'));
    }

    public function create() {
          $empresa=Empresa::paginate(9);

        return view('usuario.create', compact('empresa'));
    }

    public function store(Request $request) {
        $numero =DB::select('select count(*) as count from manzano where numero='.$request->numero);
        if ($numero[0]->count==0) {
           DB::table('manzano')->insert(['numero' => $request['numero'],'id_proyecto' => $request['id_proyecto']]);
           
        Session::flash('message', 'MANZANO CREADO CORRECTAMENTE');
        return Redirect::to('/manzano');
        }else{
       Session::flash('message-error', 'YA EXISTE ESE NUMERO DE MANZANO' );
        return Redirect::to('/manzano');}
       
           
    }

    public function edit($id) {

        $trabajador = User::find($id);
        $empresa = Empresa::where('id', $trabajador->id_empresa)->lists('nombre', 'id');

        return view('usuario.edit', ['user' => $trabajador], compact('empresa'));
    }

    public function update(Request $request) {

            $id=$request->get("id_manzano");
  $numero =DB::select('select count(*) as count from manzano where numero='.$request->numero_ac);
        if ($numero[0]->count==0) {
            $manzano=DB::table('manzano')->where('id', $id)->update(['numero' => $request['numero_ac'], 'id_proyecto' => $request['id_proyecto_ac'] ]);
        Session::flash('message', 'ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('/manzano');
    }else{
       Session::flash('message-error', 'YA EXISTE ESE NUMERO DE MANZANO' );
        return Redirect::to('/manzano');}
    }

    public function destroy($id) {
        $trabajador = User::find($id);
        $trabajador->delete();
        Session::flash('message', 'Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }

    public function cargar_manzano($id){
        $manzano=DB::select("SELECT *FROM manzano where id=".$id);
        return response($manzano);
    }
}
