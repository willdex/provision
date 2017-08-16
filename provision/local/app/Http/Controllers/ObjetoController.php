<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ObjetoRequest;
use DB;
use App\Objeto;
use App\Modulo;

use Session;
use Redirect;
class ObjetoController extends Controller
{
  var $puedeGuardar=0;
var   $puedeModificar=0;
  var  $puedeEliminar=0;
   var $puedeImprimir=0;
  var $puedeListar=0;
  var $puedeVerReporte=0;

   public function __construct(Request $request) {
    if (Session::get('user')==null || Session::get('idPerfil')=="" ) {
    Session::put('user', null); 
      $this->middleware('auth');

         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }else{
       $verficar=DB::select("select modulo.nombre,perfilobjeto.puedeGuardar,perfilobjeto.puedeModificar,perfilobjeto.puedeEliminar,perfilobjeto.puedeListar, perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir,objeto.urlObjeto from perfil,perfilobjeto,objeto,modulo where perfilobjeto.deleted_at IS NULL and perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and modulo.id=objeto.idModulo and objeto.urlObjeto='/Objeto'  and perfil.id=".Session::get('idPerfil'));
   
  
       
         if (count($verficar)==0) {
  Session::flash('message-error', 'No tiene privilegio');
      Session::put('user', null);
      $this->middleware('auth');

         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']); 
         }else{
                $this->puedeGuardar=$verficar[0]->puedeGuardar;
  $this->puedeModificar=$verficar[0]->puedeModificar;
  $this->puedeEliminar=$verficar[0]->puedeEliminar;
  $this->puedeImprimir=$verficar[0]->puedeImprimir;
  $this->puedeListar=$verficar[0]->puedeListar;
 $this->puedeVerReporte=$verficar[0]->puedeVerReporte;
         }
       
       
}
    }
function index(){
     $objeto=Objeto::paginate(10);
     return view('objeto.index',compact('objeto'));
	}
  
	public function create(){
    // $modulo=DB::select('select *from modulo ');
    if ($this->puedeGuardar==1) {
    $idModulo=Modulo::lists('nombre','id');
    return view('objeto.create',compact('idModulo',$idModulo));   
    }
    else{
       return redirect('/Objeto')->with('message-error','No tiene privilegios para guardar');  
    }
    
  }

  public function store(Request $request){
        Objeto::create([
          'nombre' => $request['nombre'],
          'tipoObjeto' => $request['tipoObjeto'],
          'urlObjeto' => $request['urlObjeto'],
          'estado' => $request['estado'],

          'visibleEnMenu' => $request['visibleEnMenu'],
          'idModulo' => $request['idModulo']

          ]);
        return redirect('/Objeto')->with('message','Guardado Correctamente');  
  }

  public function update(Request $request,$id){
    $Objeto= Objeto::find($id);
    $Objeto->fill($request->all());
    $Objeto->save();
    return redirect('/Objeto')->with('message','Modificado Correctamente');  
  }

  public function edit($id){
     if ($this->puedeModificar==1) {
    $idModulo=Modulo::lists('nombre','id');

      $objeto=Objeto::find($id);
      return view('objeto.edit',['objeto'=>$objeto],compact('idModulo'));
    }
    else{
       return redirect('/Objeto')->with('message-error','No tiene privilegios para Modificar');  

    }
  }
  public function listacategoria1(Request $request ){
      if ($request->ajax()){
      $categoria=DB::select('select *from categoria');
      return response()->json($categoria);
      
      
      }
  }

  public function destroy($id){
      $Objeto=Objeto::find($id);
      echo $id;
      $Objeto->delete();
      Session::flash('message','Eliminado Correctamente');
     return Redirect::to('/Objeto');
  }
}
