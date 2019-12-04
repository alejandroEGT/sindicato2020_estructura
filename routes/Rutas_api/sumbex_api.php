<?php

//------------->Proveedores
Route::post('/ingresar_proveedor', 'ProveedorController@IngresarProveedor');
Route::get('/traer_proveedores', 'ProveedorController@TraerProveedores');
Route::get('/traer_giros', 'ProveedorController@TraerGiros');
//------------->Proveedores

//------------->Reuniones
Route::post('/ingresar_reunion', 'ReunionController@CrearReunion');
Route::get('/traer_reuniones', 'ReunionController@TraerReuniones');
//------------->Reuniones
