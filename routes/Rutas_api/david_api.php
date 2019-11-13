<?php

Route::post('crear_cliente', 'ClienteController@crear_cliente');
Route::get('listar_cliente', 'ClienteController@listar_cliente');
Route::post('actualizar_campo_cliente', 'ClienteController@actualizar_campo_cliente');

?>