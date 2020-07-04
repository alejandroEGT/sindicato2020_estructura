<?php 
	
	Route::post('crear_cuenta','CuentaController@crear');
	Route::get('traer_cuenta','CuentaController@traer_cuenta');

	Route::post('ingresar_subcuenta','SubcuentaController@insertar');
	Route::get('traer_subcuenta/{id}','SubcuentaController@traer_subcuenta');


	Route::post('insertar_cuenta_detalle','CuentadescripcionController@crear');
	Route::get('listar_cuenta_detalle/{mes}/{anio}/{cuenta}','CuentadescripcionController@listar');
	Route::post('ini_cie_ingresar','InicioCierreController@ingresar');
	Route::get('traer_inicio_mensual/{mes}/{anio}/{cuenta}','InicioCierreController@traer_inicio_mensual');
	Route::post('actualizar_cuenta_detalle','CuentadescripcionController@actualizar');
	Route::post('actualizar_cuenta_detalle_archivo','CuentadescripcionController@actualizar_archivo');
	Route::get('eliminar_cuenta_detalle/{id}','CuentadescripcionController@eliminar_cuenta_detalle');

	Route::get('select_nombre','LiquidacionesController@select_nombre');
	Route::get('traer_datos_persona/{id}','LiquidacionesController@traer_datos_persona');

	Route::post('ingresar_detalle','DetallehaberesDescuentosController@insertar');
	Route::get('listar_detalle','DetallehaberesDescuentosController@listar_detalle');
	Route::get('eliminar_detalle_hd/{id}','DetallehaberesDescuentosController@eliminar_detalle_hd');
	Route::get('detalle_h_d','DetallehaberesDescuentosController@select_detalle_h_d');

	Route::get('afp_y_isapre','LiquidacionesController@afp_y_isapre');


	
	Route::get('listar_hh_dd','LiquidacionesController@listar_hh_dd');
	Route::post('guardar_liquidacion_datos_basicos','LiquidacionesController@guardar_liquidacion_datos_basicos');
	Route::post('guardar_liquidacion_detalle','LiquidacionesController@guardar_liquidacion_detalle');
	Route::get('listar_liquidaciones','LiquidacionesController@listar_liquidaciones');
	Route::get('listar_liquidaciones_edit','LiquidacionesController@listar_liquidaciones_edit');
	Route::get('datos_liqu_edit/{liq_id}','LiquidacionesController@datos_liqu_edit');
	Route::get('tabla_haberes_descuentos_edit/{liq_id}','LiquidacionesController@tabla_haberes_descuentos_edit');
	
	
	
	Route::post('insertar_empleado','EmpleadosController@insertar');

	//SINDICATO

	Route::post('insertar_socio','SocioController@insertar_socio');
	Route::get('listar_socios/{buscar?}','SocioController@listar_socios');
	Route::get('listar_socio/{buscar?}','SocioController@listar_socio');
	Route::get('listar_socio_id/{id}','SocioController@listar_socio_id');
	Route::post('actualizar_socio','SocioController@actualizar');
	Route::get('entorno_familiar','SocioController@entorno_familiar');
	Route::post('crear_persona','PersonaController@crear_persona');
	Route::get('listar_personas/{socio}','PersonaController@listar_personas');
	Route::post('actualizar_archivo_con','PersonaController@actualizar_archivo_con');
	Route::post('actualizar_archivo_car','PersonaController@actualizar_archivo_car');
	Route::post('actualizar_persona','PersonaController@actualizar');
	Route::post('insertar_tema_votacion','SecretariaController@insertar_tema_votacion');
	Route::get('listar_tema_votacion','SecretariaController@listar_tema_votacion');
	Route::post('finalizar_tema', 'VotarController@finalizar_tema');
	Route::post('entregar_beneficio', 'SocioController@entregar_beneficio');
	Route::get('listar_beneficios_dados/{socio_id}','SocioController@listar_beneficios_dados');

	//SOCIOS

	Route::post('votar','VotarController@votar');
	Route::get('obtener_votos/{id}','VotarController@obtener_votos');
	Route::get('obtener_votos_2/{id}','VotarController@obtener_votos_2');
	
	
	
	
 ?>