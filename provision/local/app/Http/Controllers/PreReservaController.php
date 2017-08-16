<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Cliente;
use App\PreReserva;
use App\Categoria;
use App\DetallePreReserva;
use Session;
use Redirect;
use DB;
use Hash;

class PreReservaController extends Controller {
    /*public function __construct() {
        $this->middleware('auth');
       $this->middleware('admin');
       $this->middleware('auth', ['only' => 'admin']);
    }*/

    function index() {
        $nacionalidad=DB::select('SELECT * FROM `pais` ORDER by paisnombre');
        $vendedor=DB::select('select empleado.codigo,nombre,id from empleado where codigo IS NOT NULL and deleted_at IS NULL GROUP by codigo');
        return view('pre_reserva.index',compact('vendedor','nacionalidad'));
    }

    public function create() {
        return view('empleado.create');
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
         
            $verificar=DB::select("SELECT *,COUNT(*)as contador from cliente WHERE cliente.ci=".$request['ci']);
            if ($verificar[0]->contador == 0) {
                $nombre=strtoupper($request['nombre']);
                  $apellido=strtoupper($request['apellidos']);
                  $ocupacion=strtoupper($request['ocupacion']);
                  $lugarProcedencia=strtoupper($request['lugarProcedencia']);

                  $nombre=trim($nombre);
                  $apellido=trim($apellido);
                    $ocupacion=trim($ocupacion);
                    $lugarProcedencia=trim($lugarProcedencia);


                $Cliente=Cliente::create([
                    'nombre' => $nombre,          
                    'apellidos' => $apellido,
                    'expedido' => $request['expedido'],          
                    'ocupacion' =>$ocupacion,
                    'fechaNacimiento' => $request['fechaNacimiento'],          
                    'ci' => $request['ci'],      
                    'expedido'=>$request['expedido'],
                    'idPais' => $request['idPais'],          
                    'lugarProcedencia' =>  $lugarProcedencia,          
                    'genero' => $request['genero'],          
                    'celular' => $request['celular'],          
                    'celular_ref' => $request['celular_ref'],          
                    'estadoCivil' => $request['estadoCivil'],          
                    'domicilio' => $request['domicilio'],          
                    'nit' => $request['nit'],          
                    'idEmpleado' =>  Session::get('idEmpleado'),         
                ]);
                $idCliente=$Cliente['id'];
            }else{
                $idCliente=$verificar[0]->id;                
            }
                $idPreReserva=PreReserva::create([
                    'idEmpleado' => Session::get('idEmpleado'),  //ACA VA EL ID DEL VENDEDOR Q ESTE LOGUEADO         
                    'idCliente' => $idCliente,  //ACA VA EL ID DEL VENDEDOR Q ESTE LOGUEADO         
                ]);

                //SE REGISTRA EL DETALLE DE LAS PRE RESERVAS
                $id_lote = $request->get('id_lote');
                //echo count($id_lote);
                //return;
                $cont=0;
                while ( $cont < count($id_lote)) {
                    if ($id_lote[$cont] != "") {
                         $verificar=DB::select('select count(*) as count,estado,nroLote from lote where estado<>0 and id='.$id_lote[$cont]);

                        if ($verificar[0]->count==1 ) {
                         Session::flash('message-error','El Lote nro '.$verificar[0]->nroLote.' ya no esta disponible para reservar');
                         DB::rollback();

                          return Redirect::to('PreReserva');  

                            }
                          $pre_reserva=new DetallePreReserva;
                          $pre_reserva->idLote=$id_lote[$cont];                
                          $pre_reserva->idPreReserva=$idPreReserva['id'];
                          $pre_reserva->save();
                        //DB::table('lote')->where('id',$id_lote[$cont])->update(['estado'=>1]);
                    }
                    $cont=$cont+1;
                }
                DB::commit();                             
                Session::flash('message', 'PRE-RESERVA GUARDADO CORRECTAMENTE');
                return Redirect::to('PreReserva');                     
        }catch (Exception $e) {
            DB::rollback();
            return redirect('PreReserva')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        }   
    }
    function ListaPreReserva(Request $request){
            $fecha=DB::select("SELECT curdate()as fecha");
        $lista=DB::select("SELECT cliente.id as idCliente,detalleprereserva.id as idDetalle,lote.id as idLote,prereserva.id,prereserva.fecha ,proyecto.nombre, categorialote.categoria,lote.nroLote,lote.manzano,lote.fase,lote.superficie, ROUND((preciocategoria.precio * lote.superficie),2)as precio_superficie,preciocategoria.precio, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente, cliente.ci as ci_cliente, CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, empleado.ci as ci_empleado
from prereserva,detalleprereserva,lote,categorialote,proyecto,preciocategoria,cliente,empleado
WHERE prereserva.id=detalleprereserva.idPreReserva AND detalleprereserva.idLote=lote.id AND lote.idProyecto=proyecto.id AND lote.idCategoriaLote=categorialote.id AND preciocategoria.idCategoria=categorialote.id AND cliente.id=prereserva.idCliente AND empleado.id=prereserva.idEmpleado AND preciocategoria.deleted_at IS NULL AND detalleprereserva.estado='p' AND DATE_FORMAT(prereserva.fecha,'%Y-%m-%d')='".$fecha[0]->fecha."'");

        return view('pre_reserva.lista_pre_Reserva', compact('lista'));
    }


    function BuscarListaPreReserva(Request $request){
        $lista=DB::select("SELECT cliente.id as idCliente,detalleprereserva.id as idDetalle,lote.id as idLote,prereserva.id, DATE_FORMAT(prereserva.fecha,'%d/%m/%Y %H:%i:%s') AS fecha  ,proyecto.nombre, categorialote.categoria,lote.nroLote,lote.fase,lote.manzano,lote.superficie, ROUND((preciocategoria.precio * lote.superficie),2)as precio_superficie,preciocategoria.precio, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente, cliente.ci as ci_cliente, CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, empleado.ci as ci_empleado
        from prereserva,detalleprereserva,lote,categorialote,proyecto,preciocategoria,cliente,empleado
        WHERE prereserva.id=detalleprereserva.idPreReserva AND detalleprereserva.idLote=lote.id AND lote.idProyecto=proyecto.id AND lote.idCategoriaLote=categorialote.id AND preciocategoria.idCategoria=categorialote.id AND cliente.id=prereserva.idCliente AND empleado.id=prereserva.idEmpleado AND preciocategoria.deleted_at IS NULL AND detalleprereserva.estado='p' AND DATE_FORMAT(prereserva.fecha,'%Y-%m-%d')='".$request['fecha_inicio']."'");  
        return view('pre_reserva.lista_pre_Reserva', compact('lista'));

    }

    function ControlPreReserva(Request $request){
        $lista=DB::select("SELECT prereserva.id,DATE_FORMAT(prereserva.fecha,'%d/%m/%Y %H:%i:%s') as fecha ,DATE_FORMAT((DATE_SUB(prereserva.fecha, INTERVAL -1 DAY)),'%d/%m/%Y %H:%i:%s') as vencimiento,proyecto.nombre, categorialote.categoria,lote.nroLote,lote.fase,lote.manzano,lote.superficie, ROUND((preciocategoria.precio * lote.superficie),2)as precio_superficie,preciocategoria.precio, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente, cliente.ci as ci_cliente, CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, empleado.ci as ci_empleado,empleado.id as idEmpeado
from prereserva,detalleprereserva,lote,categorialote,proyecto,preciocategoria,cliente,empleado
WHERE prereserva.id=detalleprereserva.idPreReserva AND detalleprereserva.idLote=lote.id AND lote.idProyecto=proyecto.id AND lote.idCategoriaLote=categorialote.id AND preciocategoria.idCategoria=categorialote.id AND cliente.id=prereserva.idCliente AND empleado.id=prereserva.idEmpleado AND preciocategoria.deleted_at IS NULL AND lote.estado=1 AND empleado.id=".Session::get('idEmpleado'));  
        return view('pre_reserva.control_prereserva', compact('lista'));

    }
/*
SELECT prereserva.id,prereserva.fecha ,proyecto.nombre, categorialote.categoria,lote.nroLote,lote.manzano,lote.superficie, (preciocategoria.precio * lote.superficie)as precio_superficie,preciocategoria.precio
from prereserva,detalleprereserva,lote,categorialote,proyecto,preciocategoria,empleado,cliente
WHERE prereserva.id=detalleprereserva.idPreReserva AND detalleprereserva.idLote=lote.id AND categorialote.idProyecto=proyecto.id AND lote.idCategoriaLote=categorialote.id AND preciocategoria.idCategoria=categorialote.id AND preciocategoria.deleted_at IS NULL AND prereserva.idEmpleado=empleado.id AND empleado.id=cliente.idEmpleado AND cliente.idEmpleado=prereserva.idEmpleado AND DATE_FORMAT(prereserva.fecha,'%Y-%m-%d')='2017-06-12' AND proyecto.id=1
*/


    public function edit($id) {
        $empleado = Empleado::find($id);
        return view('empleado.edit', ['empleado' => $empleado]);
    }

    public function update($id, Request $request) {
        $empleado = Empleado::find($id);
        $empleado->fill([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'celular'=>$request->celular,
            'ci'=>$request->ci,
            'celular_ref'=>$request->celular_ref,
            'genero'=>$request->genero,
        ]);
        $empleado->save();
        Session::flash('message', 'Actualizado Correctamente');
        return Redirect::to('/Empleado');
    }

    public function destroy($id) {

        $trabajador = User::find($id);
        $trabajador->delete();
        Session::flash('message', 'Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }

    function Buscar_Lote($nro_lote,$nro_manzano){
        $result=DB::select("SELECT lote.id as id_lote,lote.nroLote,lote.manzano,lote.superficie,lote.uv,lote.matricula,lote.estado,lote.point,(lote.superficie * preciocategoria.precio)as precio,preciocategoria.precio as precio_x_metro, categorialote.categoria, proyecto.id as id_proyecto,proyecto.nombre
FROM lote,categorialote,preciocategoria,proyecto 
WHERE lote.idCategoriaLote=categorialote.id AND categorialote.id=preciocategoria.idCategoria AND proyecto.id=lote.idProyecto AND lote.idProyecto=".Session::get('idProyecto')." AND lote.nroLote=".$nro_lote." AND lote.manzano=".$nro_manzano." ORDER BY preciocategoria.fecha DESC LIMIT 1"); 
        if (count($result) == 0) {
            $result=DB::select("SELECT (0)as contador");
            return response($result);            
        } else {
            return response($result);                        
        }
        
    }
  
public function seccion1($opcion){
        // $manzano = Manzano::lists('numero', 'id');     
//
    $Categoria=Categoria::lists('categoria','id');
   return view('mapas.seccion1',['opcion'=>$opcion,'categoria'=>$Categoria,'fase'=>1]) ;
}


public function seccion2($opcion){

 $Categoria=Categoria::lists('categoria','id');
   return view('mapas.seccion2',['opcion'=>$opcion,'categoria'=>$Categoria,'fase'=>2]) ;

}
public function seccion3($opcion){
 $Categoria=Categoria::lists('categoria','id');
   return view('mapas.seccion3',['opcion'=>$opcion,'categoria'=>$Categoria,'fase'=>3]) ;

}
public function seccion1b($opcion){

 $Categoria=Categoria::where('idProyecto',Session::get('idProyecto'))->lists('categoria','id');
   return view('mapas.seccion1-b',['opcion'=>$opcion,'categoria'=>$Categoria,'fase'=>1]) ;
}
}

