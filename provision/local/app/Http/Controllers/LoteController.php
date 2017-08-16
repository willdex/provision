<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Session;
use Redirect;
use App\Lote;
use App\Categoria;
use DB;
use Hash;
use Auth;

class LoteController extends Controller {

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
       $verficar=DB::select("select modulo.nombre,perfilobjeto.puedeGuardar,perfilobjeto.puedeModificar,perfilobjeto.puedeEliminar,perfilobjeto.puedeListar, perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir,objeto.urlObjeto from perfil,perfilobjeto,objeto,modulo where perfilobjeto.deleted_at IS NULL and perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and modulo.id=objeto.idModulo and objeto.urlObjeto='/Lote'  and perfil.id=".Session::get('idPerfil'));
       
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
    function index() {
        return view('lote.index');
    }

    public function create() {
        $empresa = Empresa::lists('nombre', 'id');
        return view('usuario.create', compact('empresa'));
    }

    public function storeLote(Request $request) {
        $verificar=DB::select("SELECT COUNT(*)as contador from lote WHERE manzano=".$request['manzano']." AND nroLote=".$request['nroLote']." and idProyecto=".Session::get('idProyecto'));
        if ($verificar[0]->contador == 1) {
          return response()->json(['mensaje'=>0]);
                      
        } else {
           DB::table('lote')->insert(['nroLote' => $request['nroLote'],'superficie' => $request['superficie'],'estado' => $request['estado'],'point' => $request['punto'],'manzano' => $request['manzano'],'tipo_etiqueta' => $request['tipo'],'norte' => $request['norte'],'medidaNorte' => $request['medida_norte'],'sur' => $request['sur'],'medidaSur' => $request['medida_sur'],'este' => $request['este'],'medidaEste' => $request['medida_este'],'oeste' => $request['oeste'],'medidaOeste' => $request['medida_oeste'],'matricula'=>$request['matricula'],'uv'=>$request['uv'],'idCategoriaLote'=>$request['idCategoria'],'idProyecto'=>Session::get('idProyecto'),'fase'=>$request['fase']]);        
          return response()->json(['mensaje'=>1]);
           
        }
    }

    public function edit($id) {
        $trabajador = User::find($id);
        $empresa = Empresa::where('id', $trabajador->id_empresa)->lists('nombre', 'id');
        return view('usuario.edit', ['user' => $trabajador], compact('empresa'));
    }

    public function updateLote(Request $request,$id) {
        
        $verificar=DB::select("SELECT COUNT(*)as contador from lote WHERE id<>".$id." and manzano=".$request['manzano']." AND nroLote=".$request['nroLote'].' and idProyecto='.Session::get('idProyecto'));
      
        if ($verificar[0]->contador == 1) {
          
               return response()->json(['mensaje'=>0]);
            }else{
              
                DB::table('lote')->where('id',$id)->update(['nroLote'=>$request['nroLote'], 'superficie'=>$request['superficie'],'manzano'=>$request['manzano'],'norte'=>$request['norte'],'medidaNorte'=>$request['medidaNorte'],'sur'=>$request['sur'],'medidaSur'=>$request['medidaSur'],'este'=>$request['este'],'medidaEste'=>$request['medidaEste'],'oeste'=>$request['oeste'],'medidaOeste'=>$request['medidaOeste'],'estado'=>$request['estado'],'uv'=>$request['uv'],'matricula'=>$request['matricula'],'idCategoriaLote'=>$request['idCategoria']]);       
                
               return response()->json(['mensaje'=>1]);
               
            }              
                             

    }

    public function destroy($id) {

        $trabajador = User::find($id);
        $trabajador->delete();
        Session::flash('message', 'Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }

 
function buscarLote($point){
    $verificar=DB::select('select lote.id from lote where point="'.$point.'"');
    return response()->json($verificar);
}
public function cargar_lote($punto){

$lote=array();
        $lote[0]=DB::select('SELECT lote.uv,lote.matricula, lote.estado, lote.estado, lote.norte,lote.medidaNorte,lote.sur,lote.medidaSur,lote.este,lote.medidaEste,lote.oeste,lote.medidaOeste, lote.tipo_etiqueta,lote.nroLote, lote.id as id, lote.superficie,manzano,categorialote.categoria,categorialote.id as idCategoria FROM lote,categorialote WHERE categorialote.id=lote.idCategorialote and lote.point="'.$punto.'"');
        if (count($lote)!=0) {
        $lote[1]=DB::select('select * from categorialote where id<>'.$lote[0][0]->idCategoria);
        }
        
        return response($lote);
    }
}
