<?php

// crear y mostrar clientes
Route::post('crear_cliente', 'ClienteController@crear_cliente');
Route::get('listar_cliente', 'ClienteController@listar_cliente');
Route::post('actualizar_campo_cliente', 'ClienteController@actualizar_campo_cliente');
Route::post('eliminar_cliente', 'ClienteController@eliminar_cliente');

// deudas clientes
Route::get('traer_clientes_deudas', 'ClienteController@traer_clientes_deudas');
Route::get('traer_tipo_deuda', 'ClienteController@traer_tipo_deuda');
Route::post('registro_cliente_deudas', 'ClienteController@registro_cliente_deudas');
Route::get('buscar_cliente/{rut}', 'ClienteController@buscar_cliente');
Route::get('deudas_cliente/{id}', 'ClienteController@deudas_cliente');
Route::post('modificar_campo_deuda', 'ClienteController@modificar_campo_deuda');


?>