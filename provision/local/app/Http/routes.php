
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




//cliente
Route::resource('cliente','ClienteController');
Route::get('buscarCliente/{ci}','ClienteController@buscarCliente');
Route::get('cargarModalCliente/{id}','ClienteController@cargarModalCliente');
Route::get('verificarCarnet/{ci}','ClienteController@verificarCarnet');


//lote
Route::get('cargar_lote/{punto}','LoteController@cargar_lote');
Route::get('buscarLote/{point}','LoteController@buscarLote');



Route::resource('Lote','LoteController');
Route::get('guardarLote','LoteController@storeLote');
Route::get('ModificarLote/{id}','LoteController@updateLote');



Route::get('reservas/lotes','ReservaController@reserva_lotes');
//busca por fecha
Route::get('buscar_reserva/{fecha}','ReservaController@buscar_reserva');
Route::get('buscar_reserva_ci/{ci}','ReservaController@buscar_reserva_ci');
Route::resource('anularReserva','ReservaController@anularReserva');
// Route::get('buscar_lote/{nro_lote}/{nro_manzano}','ReservaController@buscar_lote');


//seccion
Route::get('seccion1/{opcion}','PreReservaController@seccion1');//opcion1 = reserva opcion2=registro lote opcion3=venta lote
Route::get('seccion2/{opcion}','PreReservaController@seccion2');//opcion1 = reserva opcion2=registro lote opcion3=venta lote
Route::get('seccion3/{opcion}','PreReservaController@seccion3');//opcion1 = reserva opcion2=registro lote opcion3=venta lote
Route::get('seccion1b/{opcion}','PreReservaController@seccion1b');


//
Route::resource('reserva','ReservaController');


//manzano
Route::resource('manzano','ManzanoController');
Route::get('cargar_manzano/{id}','ManzanoController@cargar_manzano');




//DescuentoVenta 
/*Route::resource('descuentoVenta','DescuentoVentaController');
Route::get('verificarDescuento/{dato}/{id}','DescuentoVentaController@verificarDescuento');*/


//ventas



Route::resource('venta_reserva','VentaController@store_venta_reserva');
Route::resource('lista/ventas','VentaController');
Route::resource('venta_lote','VentaController');
Route::get('vender','VentaController@vender');

Route::get('ObtenerVenta/{idVenta}','VentaController@ObtenerVenta');

// Route::get('vender_lote/{opcion}','VentaController@vender_lote');

//TasaInteres
Route::resource('tasaInteres','TasaInteresController');
Route::get('cargarModalTasaInteres/{id}','TasaInteresController@cargarModalTasaInteres');

//Plazo
Route::resource('plazo','PlazoController');
Route::get('cargarModalPlazo/{id}','PlazoController@cargarModalPlazo');

//TiempoEspera
Route::resource('tiempoespera','TiempoEsperaController');
Route::get('cargarModalTiempoEspera/{id}','TiempoEsperaController@cargarModalTiempoEspera');

Route::get('libro_mayor','AsientoController@libro_mayor');

Route::resource('libro_diario','AsientoController@libro_diario');
//reportes de los balances
Route::get('reporte_libro_diario/{fecha1}/{fecha2}','AsientoController@reporte_libro_diario');
Route::get('reporte_libro_mayor/{fecha1}/{fecha2}','AsientoController@reporte_libro_mayor');

//moneda
Route::resource('moneda','MonedaController');

//login
Route::resource('/','LoginController');
Route::resource('login','LoginController@store');
Route::get('logout','LoginController@logout');

//cuenta
Route::resource('cuenta','CuentaController');
Route::get('lista_cuenta','CuentaController@lista_cuenta');

//detalle de asiento
Route::resource('detalle','Detallecontroller');

//extrar codigo
Route::get('extraercodigo','CuentaController@extraercodigo');




//usuario
Route::resource('Usuario','UsuarioController');
//empresa
Route::resource('Empresa','EmpresaController');
//cambiomoneda
Route::resource('moneda','CambioMonedaController');

//plan de pago

Route::get('plan_pago/{id_lote}','PlanPagoController@plan_pago');

//errores
Route::get('error',function(){
	abort(404);
});

//modulo
Route::resource('Modulo','ModuloController');

//perfil

Route::resource('Perfil','PerfilController');


//Objeto
Route::resource('Objeto','ObjetoController');

//Perfil Objeto
 Route::get('PerfilObjeto/{id}','PerfilObjetoController@index');
 
 Route::resource('PerfilObjeto','PerfilObjetoController');
 Route::get('CargarSelectPerfilObjeto/{id}','PerfilObjetoController@CargarSelectPerfilObjeto');
 Route::get('PerfilObjetoUpdate/{id}','PerfilObjetoController@update');


//empleado
 
 Route::resource('Empleado','EmpleadoController');
Route::post('BuscarEmpleado', ['as' => 'BuscarEmpleado', 'uses'=>'EmpleadoController@BuscarEmpleado']);


//index
Route::get('index',function(){
	if (Session::get('user')!=null) {
        return view('index');
    
}else{
        return view('log.index');}
});

//Autorizaciones
Route::get('Autorizaciones/{id}','AutorizacionController@autorizacion');


//Cargo
 Route::resource('Cargo','CargoController');

//turno
 Route::resource('Turno','TurnoController');


//usuario
 Route::resource('Usuario','UsuarioController');


 //PROYECTOS
Route::resource('Proyecto','ProyectoController');

//CATEGORIAS
Route::resource('Categoria','CategoriaController');


//VENDEDOR
Route::resource('Vendedor','VendedorController');
 Route::get('RegistroEmpleado','VendedorController@RegistroEmpleado');
Route::post('RegistrarEmpleadoGestor','VendedorController@RegistrarEmpleadoGestor'); //MANDA ALA FUNCION DE CREAR EMPLEADO
Route::get('Mapa','PreReservaController@Mapa');
 Route::get('ListaEmpleado','VendedorController@ListaEmpleado');
 Route::post('ActualizarEmpleadoGestor','VendedorController@ActualizarEmpleadoGestor');//REHACER ESTE ACTUALIZAR
Route::get('BuscarSuperior/{id}','VendedorController@BuscarSuperior');//ESTO AUMENTE

//PRESERVA
Route::resource('PreReserva','PreReservaController');
Route::get('ListaPreReserva','PreReservaController@ListaPreReserva');
Route::get('Buscar_Lote/{nro_lote}/{nro_manzano}','PreReservaController@Buscar_Lote');
Route::post('ListaPreReserva', ['as' => 'ListaPreReserva', 'uses'=>'PreReservaController@BuscarListaPreReserva']);
Route::get('ControlPreReserva','PreReservaController@ControlPreReserva');


//PRECIO
Route::resource('Precio','PrecioController');
//tipo de cambio
Route::resource('TipoCambio','TipoCambioController');
Route::get('AutorizarCambioMoneda','TipoCambioController@AutorizarCambioMoneda');



//reserva
Route::resource('Reserva','ReservaController');
Route::post('ListaReservasearch', ['as' => 'ListaReservasearch', 'uses'=>'ReservaController@BuscarListaReserva']);
Route::post('ListaReserva', ['as' => 'ListaReservasearchci', 'uses'=>'ReservaController@BuscarListaReservaCi']);

Route::get('ListaReserva','ReservaController@ListaReserva');

//meses
Route::resource('Meses','MesesController');

//DESCUENTO DE VENTA
Route::resource('DescuentoVenta','DescuentoVentaController');
//CUOTA MINIMA
Route::resource('CuotaMinima','CuotaMinimaController');

//VENTA
Route::resource('Venta','VentaController');
Route::get('VentaLote/{idLote}','VentaController@VentaLote');

Route::get('ListaVenta','VentaController@ListaVenta');
Route::post('ListaVentasearch', ['as' => 'ListaVentasearch', 'uses'=>'VentaController@BuscarListaVenta']);


//pagoVenta
Route::get('PagoVenta','PagoController@PagoVenta');
Route::post('PagoVenta/search', ['as' => 'PagoVenta/search', 'uses'=>'PagoController@BuscarPagoVenta']);


Route::get('VentaReserva/{idReserva}','VentaController@VentaReserva');
Route::get('VentaPreReserva/{idPreReserva}','VentaController@VentaPreReserva');

//PLAN PAGO
Route::resource('PlanPago','PlanPagoController');

// PAGO
Route::resource('Pago','PagoController');

//SESION
Route::resource('SesionVenta','SesionVentaController');

//PORCENTANJE DEVOLUCION RESERVA
Route::resource('PorcentajeDevolucionReserva','PorcentajeDevolucionReservaController');

//DEVOLUCION RESERVA
Route::resource('DevolucionReserva','DevolucionReservaController');

//BANCO
Route::resource('Banco','BancoController');


//CUENTA BANCO
Route::resource('CuentaBanco','CuentaBancoController');
Route::get('CuentaBanco/{id}','CuentaBancoController@index');


//reporte
Route::get('ReporteVenta','VentaController@ReporteVentas');
Route::post('ReporteVentasSearch', ['as' => 'ReporteVentasSearch', 'uses'=>'VentaController@ReporteVentasSearch']);
Route::get('ReporteVentaPDF/{fecha_inicio}/{fecha_fin}','VentaController@ReporteVentaPDF');

Route::get('ReporteReserva','ReservaController@reporte_reserva');
Route::post('ReporteReservaSearch', ['as' => 'ReporteReservaSearch', 'uses'=>'ReservaController@reporte_reserva_busqueda']);
Route::get('ReporteReservaPDF/{fecha_inicio}/{fecha_fin}','ReservaController@ReporteReservaPDF');



Route::get('cargarBanco',function(){
	$banco=DB::select('select *from banco ');
	return response()->json($banco);
});
Route::get('cargarCuenta/{id}',function($id){
	$cuenta=DB::select('select *from cuentabanco where idBanco='.$id);
	return response()->json($cuenta);
});



Route::get('BuscarProyecto',function(){
$proyecto=DB::select('SELECT * FROM proyecto WHERE proyecto.deleted_at IS NULL');
	return response()->json($proyecto);
});

Route::get('BuscarFase/{proyecto}',function($proyecto){
$fase=DB::select('SELECT lote.fase FROM lote WHERE lote.idProyecto='.$proyecto.' GROUP BY lote.fase');
	return response()->json($fase);
});



Route::get('BuscarManzano/{fase}/{proyecto}',function($fase,$proyecto){
$fase=DB::select('SELECT lote.manzano from lote where lote.fase='.$fase.' AND lote.idProyecto='.$proyecto.' AND estado=0 GROUP by lote.manzano ORDER BY lote.manzano');
	return response()->json($fase);
});

Route::get('BuscarLoteReserva/{manzano}/{proyecto}',function($manzano,$proyecto){//este para el formulario reserva
$lote=DB::select('SELECT id, lote.nroLote from lote where lote.manzano='.$manzano.' AND lote.idProyecto='.$proyecto.' and  estado=0 ORDER BY nroLote');
	return response()->json($lote);
});

Route::get('BuscarLoteId/{idLote}/{proyecto}',function($idLote,$proyecto){
	 $result=DB::select("SELECT lote.id as id_lote,lote.nroLote,lote.manzano,lote.superficie,lote.uv,lote.matricula,lote.estado,lote.point,(lote.superficie * preciocategoria.precio)as precio,preciocategoria.precio as precio_x_metro, categorialote.categoria, proyecto.id as id_proyecto,proyecto.nombre, descuentoventa.porcentaje,ROUND( ((lote.superficie * preciocategoria.precio)-((lote.superficie * preciocategoria.precio)*descuentoventa.porcentaje/100)),2 )as descuento
FROM lote,categorialote,preciocategoria,proyecto,descuentoventa
WHERE lote.idCategoriaLote=categorialote.id AND categorialote.id=preciocategoria.idCategoria AND proyecto.id=lote.idProyecto AND descuentoventa.idProyecto=proyecto.id AND lote.idProyecto=".$proyecto." AND lote.id=".$idLote."  AND preciocategoria.deleted_at IS NULL"); 
	 return response()->json($result);
});

Route::get('cargarCiudad/{idPaid}',function($id){
	$result=DB::select('select * from estadopais where estadopais.idPais='.$id);
	return response()->json($result);
});

Route::get('Pland_PDF/{id}','VentaController@Pland_PDF');


Route::get('vendedores','VentaController@vendedores');

Route::get('pdfPrueba',function(){
   $pdf=\PDF::loadView('pdf.pdfPrueba');
         return   $pdf->stream();   
});