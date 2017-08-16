<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoriaRequest;
use App\Categoria;
use App\PrecioCategoria;
use DB;
use Session;
use Redirect;

class CategoriaController extends Controller
{

    public function __construct(Request $request) {
     if (Session::get('user')==null || Session::get('idPerfil')=="" ) {
    Session::put('user', null); 
      $this->middleware('auth');

         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }else{
       $verficar=DB::select("select modulo.nombre,perfilobjeto.puedeGuardar,perfilobjeto.puedeModificar,perfilobjeto.puedeEliminar,perfilobjeto.puedeListar, perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir,objeto.urlObjeto from perfil,perfilobjeto,objeto,modulo where perfilobjeto.deleted_at IS NULL and perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and modulo.id=objeto.idModulo and objeto.urlObjeto='/Categoria'  and perfil.id=".Session::get('idPerfil'));
   
  
       
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
    $categoria=DB::table('categorialote')
    ->join('proyecto','proyecto.id','=','categorialote.idProyecto')
    ->select('categorialote.id', 'categorialote.categoria','categorialote.descripcion', 'proyecto.nombre','categorialote.idProyecto')
    ->where('categorialote.idProyecto',Session::get('idProyecto')) 
    ->paginate(30);
     ///$categoria=Categoria::paginate(10);
     return view('categoria.index',['categoria'=>$categoria]);//,compact('categoria'));
  }
  
  public function create(){
        if ($this->puedeGuardar==1) {
    return view('categoria.create');  
  } else{
       return redirect('/Categoria')->with('message-error','No tiene privilegios para guardar');  
    }
  }

  public function store(Request $request){

  try {
      DB::beginTransaction();    
        $idCategoria=Categoria::create([
          'categoria' => $request['categoria'],
          'descripcion' => $request['descripcion'],
          'idProyecto' => Session::get('idProyecto'),//$request['proyecto']
        ]);
              
        DB::commit();                                               
        return redirect('Categoria')->with('message','GUARDADO CORRECTAMENTE');  
    }catch (Exception $e) {
        DB::rollback();
        return redirect('Categoria')->with("message-error","ERROR INTENTE NUEVAMENTE");      
    }         
  }

  public function update(Request $request,$id){
      if ($this->puedeModificar==1) {
  try {
      DB::beginTransaction();    
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->save();

        if ($request['precio'] != $request['precio_aux']) {
          PrecioCategoria::create([ 'precio' => $request['precio'], 'idCategoria' => $id ]);           
        }
       
        DB::commit();  
        return redirect('Categoria')->with('message','MODIFICADO CORRECTAMENTE');                                                      
    }catch (Exception $e) {
        DB::rollback();
        return redirect('Categoria/'.$id.'/edit')->with("message-error","ERROR INTENTE NUEVAMENTE");      
    } 
  }
  else{
       return redirect('/Categoria')->with('message-error','No tiene privilegios para Modificar');  
    }


  }

  public function edit($id){
    $categoria=Categoria::find($id);    
    return view('categoria.edit',['categoria'=>$categoria]);
  }


  public function listacategoria1(Request $request ){
      if ($request->ajax()){
      $categoria=DB::select('select *from categoria');
      return response()->json($categoria);
      
      
      }
  }

  public function destroy($id){
      if ($this->puedeEliminar==1) {

      }else{
       return redirect('/Categoria')->with('message-error','No tiene privilegios para Eliminar');  

      }
    /*  $edad=Edad::find($id);
      $edad->delete();
      Session::flash('message','Edad Eliminado Correctamente');
     return Redirect::to('/edad');*/
  }
}
