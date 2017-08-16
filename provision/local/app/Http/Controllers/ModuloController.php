<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ModuloRequest;
use DB;
use App\Modulo;
use Session;
use Redirect;
class ModuloController extends Controller
{
function index(){
     $modulo=Modulo::paginate(10);
     return view('modulo.index',compact('modulo'));
	}
  
	public function create(){
    return view('modulo.create');		
  }

  public function store(ModuloRequest $request){
        Modulo::create([
          'nombre' => $request['nombre']]);
        return redirect('/Modulo')->with('message','Guardado Correctamente');  
  }

  public function update(ModuloRequest $request,$id){
    $modulo= Modulo::find($id);
    $modulo->fill($request->all());
    $modulo->save();
    return redirect('/Modulo')->with('message','Modificado Correctamente');  
  }

  public function edit($id){
      $modulo=Modulo::find($id);
      return view('modulo.edit',['modulo'=>$modulo]);
  }
  public function listacategoria1(Request $request ){
      if ($request->ajax()){
      $categoria=DB::select('select *from categoria');
      return response()->json($categoria);
      
      
      }
  }

  public function destroy($id){
      $modulo=Modulo::find($id);
      echo $id;
      $modulo->delete();
      Session::flash('message','Eliminado Correctamente');
     return Redirect::to('/Modulo');
  }
}
