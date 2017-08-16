<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoriaRequest;
use App\DevolucionReserva;
use App\Lote;

use App\DetalleReserva;
use DB;
use Session;
use Redirect;

class DevolucionReservaController extends Controller
{
function index(){
    $categoria=DB::table('devolucionreserva')
    ->join('proyecto','proyecto.id','=','categorialote.idProyecto')
    ->select('categorialote.id', 'categorialote.categoria','categorialote.descripcion', 'proyecto.nombre','categorialote.idProyecto')
    ->where('categorialote.idProyecto',Session::get('idProyecto')) 
    ->paginate(30);
     ///$categoria=Categoria::paginate(10);
     return view('categoria.index',['categoria'=>$categoria]);//,compact('categoria'));
  }
  
  public function create(){
    //$proyecto=DB::select("SELECT *from proyecto");
    return view('categoria.create');//,compact('proyecto',$proyecto));    
  }

  public function store(Request $request){
  try {
      DB::beginTransaction();    
        DevolucionReserva::create([
          'idDetalleReserva' => $request['idDetalleReserva'],
          'idCliente' => $request['idCliente'],
          'monto' => $request['monto'],
          'idPorcentajeDevolucionReserva' => $request['idPorcentajeDevolucion'],          
        ]);
        $lote=Lote::find($request['idLote']);
        $lote->fill(['estado'=>0]);
        $lote->save();  


        $detalle_reserva=DetalleReserva::find($request['idDetalleReserva']);
        $detalle_reserva->fill(['estado'=>'d']);
        $detalle_reserva->save();

        DB::commit();                                               
        return redirect('ListaReserva')->with('message','GUARDADO CORRECTAMENTE');  
    }catch (Exception $e) {
        DB::rollback();
        return redirect('ListaReserva')->with("message-error","ERROR INTENTE NUEVAMENTE");      
    }         
  }

  public function update(Request $request,$id){
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

  public function edit($id){
    $categoria=Categoria::find($id);    
    return view('categoria.edit',['categoria'=>$categoria]);
  }


  public function show($id){
    $datos=DB::select("SELECT lote.id as idLote,lote.nroLote,lote.fase,lote.manzano,lote.superficie, categorialote.categoria,categorialote.descripcion, proyecto.nombre as proyecto,detallereserva.id as idDetalleReserva,detallereserva.subTotal, reserva.id as idReserva,  cliente.id as idCliente,cliente.nombre,cliente.apellidos,cliente.ci FROM proyecto,categorialote,lote,reserva,detallereserva,cliente WHERE proyecto.id=categorialote.idProyecto AND proyecto.id=lote.idProyecto AND categorialote.id=lote.idCategoriaLote AND lote.id=detallereserva.idLote AND detallereserva.idReserva=reserva.id AND cliente.id=reserva.idCliente AND detallereserva.id=".$id);
    return view('devolucion_reserva.devolucion_reserva',compact('datos')); 
  }

  public function destroy($id){
    /*  $edad=Edad::find($id);
      $edad->delete();
      Session::flash('message','Edad Eliminado Correctamente');
     return Redirect::to('/edad');*/
  }
}
