<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ConsumoRequest;
use App\Pago;
use App\PlanPago;
use App\TransaccionPago;
use App\AutorizacionPago;
use App\Venta;
use Session;
use Redirect;
use DB;

class PagoController extends Controller {
  var $puedeGuardar=0;
var   $puedeModificar=0;
  var  $puedeEliminar=0;
   var $puedeImprimir=0;
  var $puedeListar=0;
  var $puedeVerReporte=0;
     public function __construct(Request $request) {
     if (Session::get('user')==null || Session::get('idPerfil')=="" ) {
    Session::put('user', null); 
      $this->middleware('auth');

         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }else{
       $verficar=DB::select("select modulo.nombre,perfilobjeto.puedeGuardar,perfilobjeto.puedeModificar,perfilobjeto.puedeEliminar,perfilobjeto.puedeListar, perfilobjeto.puedeVerReporte,perfilobjeto.puedeImprimir,objeto.urlObjeto from perfil,perfilobjeto,objeto,modulo where perfilobjeto.deleted_at IS NULL and perfil.id=perfilobjeto.idPerfil and perfilobjeto.idObjeto=objeto.id and modulo.id=objeto.idModulo and objeto.urlObjeto='/PagoVenta'  and perfil.id=".Session::get('idPerfil'));
       
         if (count($verficar)==0) {
  Session::flash('message-error', 'No tiene privilegio');
      Session::put('user', null);
      $this->middleware('auth');

         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']); 
         }else{
                $this->puedeGuardar=$verficar[0]->puedeGuardar;
  $this->puedeModificar=$verficar[0]->puedeModificar;
  $this->puedeEliminar=$verficar[0]->puedeEliminar;
  $this->puedeImprimir=$verficar[0]->puedeImprimir;
  $this->puedeListar=$verficar[0]->puedeListar;
 $this->puedeVerReporte=$verficar[0]->puedeVerReporte;
         }
       

    }
  }

  function index() {
     $pago=DB::select("SELECT * FROM planpago WHERE planpago.estado='d'");
      return view('planpago.index', compact('pago'));
  }

  public function store(Request $request) {
    try {
      DB::beginTransaction();              
      $monto = $request['monto'] + $request['montoBanco'];
      switch ($request['tipoPago']) {
      case 'e':
        if ($request['monto'] == "") {
          DB::rollback();
          Session::flash('message-error', 'INTRODUSCA LOS DATOS REQUERIDOS');
          return Redirect::to('PlanPago/'.$request['idVenta']);           
        }
        break;
      case 'b':
        if ($request['montoBanco'] == "" || $request['nroDocumento'] == "" || $request['banco'] == 0 || $request['cuenta'] == 0) {
          DB::rollback();
          Session::flash('message-error', 'INTRODUSCA LOS DATOS REQUERIDOS');
          return Redirect::to('PlanPago/'.$request['idVenta']);           
        }   
        break;        
      case 'be':
        if ($request['monto'] == "" || $request['montoBanco'] == "" || $request['nroDocumento'] == "" || $request['banco'] == 0 || $request['cuenta'] == 0) {
          DB::rollback();
          Session::flash('message-error', 'INTRODUSCA LOS DATOS REQUERIDOS');
          return Redirect::to('PlanPago/'.$request['idVenta']);           
        }         
        break;        
      }      
     
        $pago=DB::select("SELECT (IFNULL(SUM(pago.monto),0) + ".$monto.")as monto FROM pago WHERE pago.idVenta=".$request['idVenta']);// LA SUMA DE LA TABLA DE PAGO DE ESA VENTA MAS LO Q ESTA INTRODUCIENDO EN EL TEXTO
        $cuota=DB::select("SELECT SUM(planpago.cuota)as cuota from planpago WHERE planpago.idVenta=".$request['idVenta']);//LA SUMA DE TODO EL PLAN DE PAGO DE ESA VENTA
        $cuota_pago=DB::select("SELECT *from planpago WHERE planpago.idVenta=".$request['idVenta']." LIMIT 1");//OBTENGO LA CUOTA Q SE PAGA POR MES

        if ($pago[0]->monto > $cuota[0]->cuota) { //EN CASO Q SEA MAYOR L MONTO Q INTRODUJO Q LA CUOTA A PAGAR
          Session::flash('message-error', 'LA CANTIDAD A COBRAR ES MAYOR AL MONTO A PAGAR');
          return Redirect::to('PlanPago/'.$request['idVenta']);             
        } else {//SI NO HACE TODA LA OPERACION DE PAGAR CUOTA
          if ($pago[0]->monto == $cuota[0]->cuota) {
            //CUANDO YA SE PAGO TODO LA CUOTA
            $debe=DB::select("SELECT *from planpago WHERE planpago.estado='d' AND planpago.idVenta=".$request['idVenta']);                
            foreach ($debe as $key => $value) { //ENTRA AL FOREACH Y ACTUALIZA EL ESTADO DEL PLAN DE PAGO
              $planpago = PlanPago::find($value->id);
              $planpago->fill(['estado' => 'p' ]);
              $planpago->save();      
            }
            $Pago=Pago::create(['monto'=>$monto, 'idVenta'=>$request['idVenta'],'tipoPago'=>$request['tipoPago'] ]);  //CREO EN LA TABLA PAGO LO Q CANCELO EN MONTO
            $venta = Venta::find($request['idVenta']);//ACTUALIZO EL ESTADO DE LA TABLA VENTA 
            $venta->fill(['estado' => 'p']);
            $venta->save();                           
          }else{
              $verificar=$pago[0]->monto / $cuota_pago[0]->cuota; 
              $pagado=DB::select("SELECT COUNT(*)as contador FROM planpago WHERE planpago.estado='p' AND planpago.idVenta=".$request['idVenta']);
              if (intval($verificar) > $pagado[0]->contador) {
                $limit = intval($verificar) - $pagado[0]->contador;
                $debe=DB::select("SELECT * FROM planpago WHERE planpago.idVenta=".$request['idVenta']." AND planpago.estado='d' LIMIT ".$limit);        
                foreach ($debe as $key => $value) { //ENTRA AL FOREACH Y ACTUALIZA EL ESTADO DEL PLAN DE PAGO
                  $planpago = PlanPago::find($value->id);
                  $planpago->fill(['estado' => 'p']);
                  $planpago->save();      
                }
                $Pago=Pago::create(['monto'=>$monto, 'idVenta'=>$request['idVenta'],'tipoPago'=>$request['tipoPago'] ]);  //CREO EN LA TABLA PAGO LO Q CANCELO EN MONTO                    
              } else {
                $Pago=Pago::create(['monto'=>$monto, 'idVenta'=>$request['idVenta'],'tipoPago'=>$request['tipoPago'] ]);  //CREO EN LA TABLA PAGO LO Q CANCELO EN MONTO                  
              }
          }
          if ($request['tipoPago'] != 'e') { //Cuando es distinto de 'e' significa q escogio banco o banco-efectivo por lo tanto igual se crea en la tabla transaccion pago
            TransaccionPago::create(['idPago'=>$Pago['id'], 'idBanco'=>$request['banco'],'idCuenta'=>$request['cuenta'],'nroDocumento'=>$request['nroDocumento'],'monto'=>$request['montoBanco'], 'fecha'=>$request['fecha'] ]); //SE CREA EN LA TABLA TRANSACCIONPAGO CUANDO ELIGE TIPO BANCO                            
          } 
          
          if(Session::get('idPerfilAutorizacion')!=null){
            AutorizacionPago::create(['idEmpleado'=>Session::get('idPerfilAutorizacion'), 'moneda'=>$request['compra_aux'],'idPago'=>$Pago['id'] ]);
            Session::put('idPerfilAutorizacion', null);  
          }

          DB::commit();
          Session::flash('message', 'GUARDADO CORRECTAMENTE');
          return Redirect::to('PlanPago/'.$request['idVenta']);            
        }
    } catch (Exception $e) {
      DB::rollback();
      Session::flash('message-error', 'ERROR, INTENTE NUEVAMENTE');
      return Redirect::to('PlanPago/'.$request['idVenta']);           
    }
  }

  function PagoVenta(Request $request){
        $fecha=DB::select("SELECT curdate()as fecha"); // %H:%i:%s
        $lista=DB::select("SELECT venta.id,DATE_FORMAT(venta.fecha,'%d/%m/%Y') AS fecha,venta.cuotaInicial,venta.precio,venta.estado as estado_venta, empleado.ci as ci_empleado,CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente,cliente.ci as ci_cliente,cliente.celular,cliente.celular_ref,proyecto.nombre, categorialote.categoria,categorialote.descripcion, lote.nroLote,lote.manzano,lote.superficie,lote.uv,lote.matricula,lote.estado as estado_lote, preciocategoria.precio as precio_categoria
from venta,empleado,cliente,lote,categorialote,proyecto,preciocategoria
WHERE venta.idEmpleado=empleado.id AND venta.idCliente=cliente.id AND lote.id=venta.idLote AND categorialote.id=lote.idCategoriaLote AND proyecto.id=categorialote.idProyecto AND preciocategoria.idCategoria=categorialote.id AND preciocategoria.deleted_at IS NULL AND venta.estado='C' AND proyecto.id=".Session::get('idProyecto')." LIMIT 30");
        return view('venta.pago_venta', compact('lista'));
    }

    function BuscarPagoVenta(Request $request){ // %H:%i:%s
        $lista=DB::select("SELECT venta.id,DATE_FORMAT(venta.fecha,'%d/%m/%Y') AS fecha,venta.cuotaInicial,venta.precio,venta.estado as estado_venta, empleado.ci as ci_empleado,CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente,cliente.ci as ci_cliente,cliente.celular,cliente.celular_ref,proyecto.nombre, categorialote.categoria,categorialote.descripcion, lote.nroLote,lote.manzano,lote.superficie,lote.uv,lote.matricula,lote.estado as estado_lote, preciocategoria.precio as precio_categoria
from venta,empleado,cliente,lote,categorialote,proyecto,preciocategoria
WHERE venta.idEmpleado=empleado.id AND venta.idCliente=cliente.id AND lote.id=venta.idLote AND categorialote.id=lote.idCategoriaLote AND proyecto.id=categorialote.idProyecto AND preciocategoria.idCategoria=categorialote.id AND preciocategoria.deleted_at IS NULL AND cliente.ci='".$request['ci']."' AND venta.estado='C' AND proyecto.id=".Session::get('idProyecto'));  
        return view('venta.pago_venta', compact('lista'));
    }
  public function show($id){
    $pago=DB::select("SELECT *from pago WHERE pago.idVenta=".$id);
    $informacion=DB::select("SELECT venta.id,DATE_FORMAT(venta.fecha,'%d/%m/%Y') AS fecha,venta.cuotaInicial,venta.precio,venta.estado as estado_venta, empleado.ci as ci_empleado,CONCAT(empleado.nombre,' ',empleado.apellido)as empleado, CONCAT(cliente.nombre,' ',cliente.apellidos)as cliente,cliente.ci as ci_cliente,cliente.celular,cliente.celular_ref,proyecto.nombre, categorialote.categoria,categorialote.descripcion, lote.nroLote,lote.manzano,lote.superficie,lote.uv,lote.matricula,lote.estado as estado_lote, preciocategoria.precio as precio_categoria from venta,empleado,cliente,lote,categorialote,proyecto,preciocategoria WHERE venta.idEmpleado=empleado.id AND venta.idCliente=cliente.id AND lote.id=venta.idLote AND categorialote.id=lote.idCategoriaLote AND proyecto.id=categorialote.idProyecto AND preciocategoria.idCategoria=categorialote.id AND preciocategoria.deleted_at IS NULL AND proyecto.id=".Session::get('idProyecto')." AND venta.id=".$id);
    return view('pago.pagos', compact('pago','informacion'));
  }    
}
