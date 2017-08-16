<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Proyecto;
use App\Categoria;
use App\PrecioCategoria;

use Session;
use Redirect;
use DB;
use Hash;

class ProyectoController extends Controller {
    /*public function __construct() {
        $this->middleware('auth');
       $this->middleware('admin');
       $this->middleware('auth', ['only' => 'admin']);
    }*/

    function index() {
        $proyecto = Proyecto::paginate(20);
        return view('proyecto.index', compact('proyecto'));
    }

    public function create() {
        return view('proyecto.create');
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
                $idProyecto=Proyecto::create([
                    'nombre' => $request['nombre'],          
                    'ubicacion' => $request['ubicacion'],               
                ]);

                //SE REGISTRA LAS CATEGORIAS
                $categoria_lote = $request->get('categoria');
                $precio_lote = $request->get('precio');
                $cont=0;
                while ( $cont < count($categoria_lote)) {
                    if ($categoria_lote[$cont] != "") {
                        $idCategoria=Categoria::create([
                            'categoria' => $categoria_lote[$cont],        
                            'idProyecto' => $idProyecto['id'],               
                        ]);
                        PrecioCategoria::create([     
                            'precio' => $precio_lote[$cont],          
                            'idCategoria' => $idCategoria['id'],               
                        ]);                        
                    }
                    $cont=$cont+1;
                }

                DB::commit();                             
                Session::flash('message', 'CREADO CORRECTAMENTE');
                return Redirect::to('/Proyecto');                    
            }catch (Exception $e) {
                DB::rollback();
                return redirect('/Proyecto/create')->with("message-error","ERROR INTENTE NUEVAMENTE");      
            }     
    }

    public function edit($id) {
        $proyecto = Proyecto::find($id);
        return view('proyecto.edit', ['proyecto' => $proyecto]);
    }

    public function update($id, Request $request) {
        $proyecto = Proyecto::find($id);
        $proyecto->fill($request->all());
        $proyecto->save();
        $proyecto->save();
        Session::flash('message', 'ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('Proyecto');
    }

    public function destroy($id) {

        $trabajador = User::find($id);
        $trabajador->delete();
        Session::flash('message', 'Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }

}
