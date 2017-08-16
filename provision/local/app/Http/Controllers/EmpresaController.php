<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use Auth;

use App\Http\Requests;
use App\Http\Requests\EmpresaRequest;
use Session;
use Redirect;

use DB;
class EmpresaController extends Controller
{
         public function __construct(Request $request) {

        
             }
	function index(){
         
        $empresa=Empresa::paginate(9);
       return view('empresa.index',compact('empresa'));
	}
  
  
	public function create(){
      return view('empresa.create');	
    }
    
    public function store(EmpresaRequest $request){
         try {
                  DB::beginTransaction();
                  	Empresa::create([
            'nombre' => $request['nombre'],
            'direccion' => $request['direccion'],
            'telefono' => $request['telefono'],
            'nit' => $request['nit'],
            'correo' => $request['correo'],
            
        ]);
         DB::commit();
                    
        Session::flash('message','Empresa Creado Correctamente');
        return Redirect::to('/Empresa');
        
         } catch (Exception $ex) {
               DB::rollback();
            echo $exc->getTraceAsString();

         }
    
    }

    public function edit($id){
    		
   $empresa = Empresa::find($id);
   return view('empresa.edit',['empresa'=>$empresa]);
    }

public function update($id, EmpresaRequest $request){
        $user =Empresa::find($id);
        $user->fill($request->all());
        $user->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/Empresa');

    }
    
    public function destroy($id, Request $request){

        $empresa=Empresa::find($id);
        $empresa->delete();
        Session::flash('message','empresa Eliminado Correctamente');
       return Redirect::to('/empresa');
    }
    

}
