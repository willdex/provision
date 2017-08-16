<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Gestion;
use App\Cuenta;
use App\Asiento;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\MySqlConnection;

class AsientoController extends Controller {

    var $id_empresa = "";

    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

    function index($id, Request $request) {

        $usuario = DB::select('select *from users where id=' . $request->user()->id);

        $gestion = DB::select('SELECT MAX(id)as id,nombre_gestion FROM gestion');
        $moneda = DB::select('SELECT MAX(tipo_cambio) as cambio,id FROM moneda');
    
        $tipo_asiento = DB::select('select nombre,id from categoria where id='.$id);
        $cuenta = DB::select("SELECT * FROM `cuenta` WHERE cuenta.utilizable=1");


        return view('asientos.index', compact($tipo_asiento, 'tipo_asiento', $gestion, 'gestion'
                        , $moneda, 'moneda', $cuenta, 'cuenta', 'usuario', $usuario));
    }
    function menu_categoria(){//esta funcion return la lista de categoria para el menu
        
        $resultado=DB::select('select id, nombre from categoria');
        
        return response()->json($resultado);
    }

    function store(Request $request) {
        $nmro_asiento = DB::select('select max(nro_asiento) as nro_asiento from asiento');
        $total = $nmro_asiento[0]->nro_asiento + 1;

        if ($request->ajax()) {
            try {
                DB::beginTransaction();

//           $id=Asiento::create($request->all());
                $id = Asiento::create([
                            'glosa' => $request->glosa,
                            'nro_asiento' => $total,
                            'fecha' => $request->fecha,
                            'cambio_tipo' => $request->cambio_tipo,
                            'estado' => $request->estado,
                            'id_categoria' => $request->id_categoria,
                            'id_gestion' => $request->id_gestion,
                            'id_moneda' => $request->id_moneda,
                            'id_usuario' => $request->id_usuario,
                ]);
                DB::commit();
                return response()->json($id);
            } catch (\Exception $e) {
                DB::roolback();
                return response()->json($e);
            }
        }
    }

    function lista_asiento(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        $lista_asiento = DB::select("SELECT asiento.id, asiento.nro_asiento, asiento.glosa, asiento.fecha, asiento.cambio_tipo, categoria.nombre as categoria, gestion.nombre_gestion from asiento,categoria,moneda,gestion,users,empresa WHERE asiento.id_categoria=categoria.id AND asiento.id_gestion=gestion.id and asiento.id_moneda=moneda.id AND asiento.id_gestion=(SELECT MAX(id) as id from gestion) and users.id_empresa=empresa.id and empresa.id=" . $id_empresa[0]->id . " and users.id=asiento.id_usuario  ORDER by asiento.id");
        $gestion = DB::select("SELECT *from gestion ORDER by id");
        return view('asientos.lista_asiento', compact('lista_asiento', 'gestion'));
    }

    function libro_diario(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        return view('asientos.libro_diario', compact('id_empresa'));
    }

    function reporte_libro_diario($fecha1, $fecha2, Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        $resultado = DB::select('SELECT DISTINCT asiento.nro_asiento as numero,asiento.fecha, asiento.glosa,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento,users,empresa  '
                        . 'WHERE asiento.id_usuario=users.id and empresa.id=users.id_empresa and  cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and empresa.id=' . $id_empresa[0]->id . ' and asiento.fecha BETWEEN "' . $fecha1 . '" AND "' . $fecha2 . '" ORDER BY asiento.fecha,asiento.nro_asiento,asiento.glosa');
        return response()->json($resultado);
    }

    public function devolver_empresa(Request $request){
       $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id); 
       return $id_empresa;
    }
    function libro_mayor(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        $resultado = DB::select('SELECT DISTINCT asiento.nro_asiento as numero,asiento.fecha, asiento.glosa,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento,users,empresa  WHERE asiento.id_usuario=users.id and empresa.id=users.id_empresa and  cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and empresa.id=1 and asiento.fecha BETWEEN "2016-01-01" AND "2016-12-30" ORDER BY asiento.fecha,asiento.nro_asiento,asiento.glosa');
        return view('asientos.libro_mayor', compact('id_empresa'));
    }

    function reporte_libro_mayor($fecha1,$fecha2,Request $request) {
       
        $libro_mayor = array();
        $resultado = DB::select('select *from cuenta where cuenta.utilizable=1 ORDER BY cuenta.codigo');
        $count = 0;
        foreach ($resultado as $key => $value) {
            $verificar=DB::select('SELECT asiento.nro_asiento as numero,asiento.fecha,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento WHERE cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and cuenta.id=' . $value->id . ' and asiento.fecha BETWEEN "' . $fecha1 . '" AND "' . $fecha2 . '" ORDER BY asiento.fecha');
            if (count($verificar)!=0) {
                $libro_mayor[$count] = $verificar;
             $count++;
            }
            
            
            
        }
      
        return response()->json($libro_mayor);
    }

}
