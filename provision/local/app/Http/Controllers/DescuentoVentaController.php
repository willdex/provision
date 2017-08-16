<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DescuentoVenta;
use App\Http\Requests;
use App\Http\Requests\UserUpdateRequest;
use Session;
use Redirect;
use DB;
use Hash;

class DescuentoVentaController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//        $this->middleware('admin');
//        $this->middleware('auth', ['only' => 'admin']);
    }

    function index() {
        $descuentoVenta = DB::select("SELECT *from proyecto,descuentoventa WHERE proyecto.id=descuentoventa.idProyecto and descuentoventa.deleted_at IS NULL and proyecto.id=".Session::get('idProyecto'));
        return view('descuento_venta.index', compact('descuentoVenta'));
    }

    public function create() {
        return view('descuento_venta.create');
    }

    public function store(Request $request) {
        try {
          DB::beginTransaction();  
           $descuento=DB::select("SELECT *from descuentoventa WHERE descuentoventa.idProyecto=".Session::get('idProyecto')." AND descuentoventa.deleted_at IS NULL");
           if(count($descuento) != 0)
            {
              $this->destroy($descuento[0]->id);
            }
            DescuentoVenta::create([
                'porcentaje'=>$request['porcentaje'],
                'idProyecto'=>Session::get('idProyecto'),
            ]);
            DB::commit(); 
            return redirect('DescuentoVenta')->with('message','GUARDADO CORRECTAMENTE');  
        }catch (Exception $e) {
            DB::rollback();
            return redirect('DescuentoVenta/create')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        } 
    }

    public function destroy($id) {
        $descuento = DescuentoVenta::find($id);
        $descuento->delete();
    }

}
