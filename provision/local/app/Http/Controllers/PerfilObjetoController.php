<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ObjetoRequest;
use DB;
use App\Objeto;
use App\Modulo;
use App\Perfil;
use App\PerfilObjeto;
use Session;
use Redirect;
class PerfilObjetoController extends Controller
{
function index($id){
$objeto = Objeto::lists('nombre','id');
$perfil = DB::select('select *from perfil where deleted_at IS NULL and  id='.$id);
$perfilObjeto=DB::select('select perfilobjeto.id, objeto.nombre, perfilobjeto.puedeGuardar as puedeGuardar, perfilobjeto.puedeModificar, perfilobjeto.puedeEliminar,perfilobjeto.puedeListar,perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir from perfilobjeto,perfil,objeto where perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and perfil.id='.$id);

     return view('perfilobjeto.index',compact('objeto','perfil','perfilObjeto'));
    }
  
    public function create(){
    // $modulo=DB::select('select *from modulo ');
    $idModulo=Modulo::lists('nombre','id');
    return view('objeto.create',compact('idModulo',$idModulo));     
  }

  public function store(Request $request){
    $verificar=DB::select('select count(*) as count from perfilobjeto where deleted_at IS NULL and idObjeto='.$request['idObjeto'].' and idPerfil='.$request['idPerfil']);
    if ($verificar[0]->count<1) {
      
          
        PerfilObjeto::create([
          'idPerfil' => $request['idPerfil'],
          'idObjeto' => $request['idObjeto'],
          'puedeGuardar' => $request['puedeGuardar'],
          'puedeModificar' => $request['puedeModificar'],
          'puedeEliminar' => $request['puedeEliminar'],
          'puedeListar' => $request['puedeListar'],
          'puedeVerReporte' => $request['puedeVerReporte'],
          'puedeImprimir' => $request['puedeImprimir'],
          ]);
        return redirect('/PerfilObjeto/'.$request['idPerfil'])->with('message','Guardado Correctamente');  
      }else{
        return redirect('/PerfilObjeto/'.$request['idPerfil'])->with('message-error','Ya existe ese Objeto');  
      }
  }

  public function update(Request $request,$id){
    $Objeto= PerfilObjeto::find($request['idPerfilObjeto']);

    $Objeto->fill($request->all());
    $Objeto->save();
      return response()->json($request); 
  }

  public function edit($id){
    $idModulo=Modulo::lists('nombre','id');

      $objeto=Objeto::find($id);
      return view('Objeto.edit',['objeto'=>$objeto],compact('idModulo'));
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
  public function CargarSelectPerfilObjeto($id){
    $select=DB::select('select objeto.nombre ,objeto.id as idObjeto from perfilobjeto,objeto where perfilobjeto.idObjeto=objeto.id and perfilobjeto.id='.$id.' 
      UNION 
     select objeto.nombre ,objeto.id as idObjeto from objeto where id<>'.$id);
    return response()->json($select);
  }
}
