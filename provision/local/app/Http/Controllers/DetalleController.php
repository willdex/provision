<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detalle;
use App\Asiento;
use App\Http\Requests;
use DB;
use Illuminate\Database\Events\TransactionBeginning;
use Session;
use Redirect;

class DetalleController extends Controller {

    function index() {
        
    }

    function store(Request $request) {
        $count = 0;
        $total_debe = 0;
        $total_haber = 0;
        $id_cuenta = $request->get('id_cuenta');
        $debe = $request->get('debe');
        $haber = $request->get('haber');
        while ($count < count($id_cuenta)) {
            $total_debe = $total_debe + $debe[$count];
            $total_haber = $total_haber + $haber[$count];
            $count = $count + 1;
        }

        if ($total_debe == $total_haber) {
            try {
                $nmro_asiento = DB::select('select max(nro_asiento) as nro_asiento from asiento');
                $total = $nmro_asiento[0]->nro_asiento + 1;
                DB::beginTransaction();
                $insert = Asiento::create([
                            'nro_asiento' => $total,
                            'glosa' => $request->glosa,
                            'fecha' => $request->fecha,
                            'cambio_tipo' => $request->cambio_tipo,
                            'estado' => 1,
                            'id_categoria' => $request->id_categoria,
                            'id_gestion' => $request->id_gestion,
                            'id_moneda' => $request->id_moneda,
                            'id_usuario' => $request->id_usuario,
                ]);

                $id = $insert->id;

                $count = 0;

                while ($count < count($id_cuenta)) {
                    $detalle = new Detalle();
                    $detalle->id_asiento = $id;
                    $detalle->id_cuenta = $id_cuenta[$count];
                    $detalle->debe = $debe[$count];
                    $detalle->haber = $haber[$count];
                    $detalle->save();

//                $insert=Asiento::create([
//                    'id_asiento'=>$id,
//                    'id_cuenta'=>$request[count]->id_cuenta,
//                    'debe'=>$request[count]->debe,
//                    'haber'=>$request[count]->haber,
//                ]);
                    $count = $count + 1;
                }

                DB::commit();
                Session::flash('message', 'GUARDADO CORRECTAMENTE');
                return Redirect::to('/asiento/' . $request->id_gestion);
            } catch (Exception $ex) {
                DB::rollback();
            }
        } else {
            Session::flash('message-error', 'POR FAVOR CUADRE SU ASIENTO');
            return Redirect::to('/asiento/' . $request->id_gestion);
        }
    }

}
