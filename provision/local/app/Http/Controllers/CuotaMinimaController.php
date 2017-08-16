<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuotaMinima;
use App\Http\Requests;
use App\Http\Requests\UserUpdateRequest;
use Session;
use Redirect;
use DB;
use Hash;

class CuotaMinimaController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//        $this->middleware('admin');
//        $this->middleware('auth', ['only' => 'admin']);
    }

    function index() {
        $CuotaMinima = DB::select("SELECT *from proyecto,cuotaminima WHERE proyecto.id=cuotaminima.idProyecto and cuotaminima.deleted_at IS NULL and proyecto.id=".Session::get('idProyecto'));
        return view('cuota_minima.index', compact('CuotaMinima'));
    }

    public function create() {
        return view('cuota_minima.create');
    }

    public function store(Request $request) {
        try {
          DB::beginTransaction();  
           $descuento=DB::select("SELECT *from cuotaminima WHERE cuotaminima.idProyecto=".Session::get('idProyecto')." AND cuotaminima.deleted_at IS NULL");
           if(count($descuento) != 0)
            {
              $this->destroy($descuento[0]->id);
            }
            CuotaMinima::create([
                'porcentaje'=>$request['porcentaje'],
                'idProyecto'=>Session::get('idProyecto'),
            ]);
            DB::commit(); 
            return redirect('CuotaMinima')->with('message','GUARDADO CORRECTAMENTE');  
        }catch (Exception $e) {
            DB::rollback();
            return redirect('CuotaMinima/create')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        } 
    }

    public function destroy($id) {
        $descuento = CuotaMinima::find($id);
        $descuento->delete();
    }

}
