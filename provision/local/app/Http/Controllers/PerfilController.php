<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PerfilRequest;
use DB;
use App\Perfil;
use Session;
use Redirect;
class PerfilController extends Controller
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
       $verficar=DB::select("select modulo.nombre,perfilobjeto.puedeGuardar,perfilobjeto.puedeModificar,perfilobjeto.puedeEliminar,perfilobjeto.puedeListar, perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir,objeto.urlObjeto from perfil,perfilobjeto,objeto,modulo where perfilobjeto.deleted_at IS NULL and perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and modulo.id=objeto.idModulo and objeto.urlObjeto='/Perfil'  and perfil.id=".Session::get('idPerfil'));
   
  
       
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
     $perfil=Perfil::paginate(10);
     return view('perfil.index',compact('perfil'));
	}
  
	public function create(){
        if ($this->puedeGuardar==1) {
    return view('perfil.create');		
  }
    else{
       return redirect('/Perfil')->with('message-error','No tiene privilegios para guardar');  
    }
  }

  public function store(Request $request){
        Perfil::create([
          'nombre' => $request['nombre']]);
        return redirect('/Perfil')->with('message','Guardado Correctamente');  
  }

  public function update(Request $request,$id){
    $Perfil= Perfil::find($id);
    $Perfil->fill($request->all());
    $Perfil->save();
    return redirect('/Perfil')->with('message','Modificado Correctamente');  
  }

  public function edit($id){
      if ($this->puedeModificar==1) {
    
  
      $perfil=Perfil::find($id);
      return view('perfil.edit',['perfil'=>$perfil]);
}
       else{
       return redirect('/Perfil')->with('message-error','No tiene privilegios para guardar');  
    }
  }
  public function listacategoria1(Request $request ){
      if ($request->ajax()){
      $categoria=DB::select('select *from categoria');
      return response()->json($categoria);
      
      
      }
  }

  public function destroy($id){
      $perfil=Perfil::find($id);
      echo $id;
      $perfil->delete();
      Session::flash('message','Eliminado Correctamente');
     return Redirect::to('/Perfil');
  }
}
