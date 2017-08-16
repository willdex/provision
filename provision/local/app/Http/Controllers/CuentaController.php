<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Galpon;
use App\Silos;
use App\Http\Requests;
use App\Http\Requests\ConsumoRequest;
use Session;
use Redirect;
use DB;

class CuentaController extends Controller {

    
     public function __construct(Request $request) {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
        
    }
    function index() {
        $cuenta = DB::select("select*from cuenta  ");
        $id_padre = DB::select("select nombre,id,codigo from  cuenta where hijo=1 order by id desc");

        return view('cuenta.index', compact('cuenta', 'id_padre', $id_padre));
    }

    public function create() {
        $galpon = Galpon::lists('nombre', 'id');
        $silos = Silos::lists('nombre', 'id');
        return view('consumo.create', compact('galpon', $galpon, 'silos', $silos));
        $cant = DB::table('silo')->where('id', '1');
        echo $cant->id;
        echo "$consumo";
    }

    public function store(Request $request) {
         $verificar = DB::select("select count(*) as count  from cuenta where  codigo='" . $request->codigo."'");

            if ($verificar[0]->count==0){
                 try {
            $resultado = DB::select("select id_empresa from  users where id=" . $request->user()->id); //obtiene el id empresa para luego registrar con ese id a la cuenta
           

            
            DB::beginTransaction();

            Cuenta::create([
                'id_empresa' => $resultado[0]->id_empresa,
                'codigo' => $request->codigo,
                'id_padre' => $request->id_padre,
                'hijo' => $request->hijo,
                'nombre' => $request->nombre,
                'utilizable' => $request->utilizable,
                'estado' => $request->estado,
            ]);
            DB::commit();
            Session::flash('message', 'GUARDADO CORRECTAMENTE');
            return Redirect::to('/cuenta');
        } catch (Exception $exc) {
            DB::rollback();
            echo $exc->getTraceAsString();
        }
                
            }else {
               Session::flash('message-error', 'POR FAVOR REGISTRE SU CUENTA CORRECTAMENTE'); 
                 return Redirect::to('/cuenta');
            }
       
    }

    public function edit($id) {
        $consumo = Consumo::find($id);
        $galpon = Galpon::lists('nombre', 'id');
        $silos = Silos::lists('nombre', 'id');
        return view('consumo.edit', compact('galpon', $galpon, 'silos', $silos), ['consumo' => $consumo]);
    }

    public function update($id, ConsumoRequest $request) {
        $consumo = Consumo::find($id);
        $consumo->fill($request->all());
        $consumo->save();
        Session::flash('message', 'Consumo Actualizado Correctamente');
        return Redirect::to('/consumo');
    }

    public function destroy($id) {
        $consumo = Consumo::find($id);
        $consumo->delete();
        Consumo::destroy($id);
        Session::flash('message', 'Consumo Eliminado Correctamente');
        return Redirect::to('/consumo');
    }
    public function extraercodigo(Request $request){//extrae el codigo del id_padre
        if ($request->ajax()) {
                    $codigo=DB::select('select codigo from cuenta where id='.$request->id_padre);
                    return response()->json($codigo[0]->codigo);
        }
        
    }
    

}
