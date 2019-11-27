<?php

//------------->Proveedores
Route::post('/ingresar_proveedor', 'ProveedorController@IngresarProveedor');
Route::get('/traer_proveedores', 'ProveedorController@TraerProveedores');
Route::get('/traer_procedencia', 'ProveedorController@TraerProcedencia');
Route::get('/traer_giros', 'ProveedorController@TraerGiros');
Route::get('/traer_tipos', 'ProveedorController@TraerTipos');
//------------->Proveedores

//------------->Reuniones
Route::post('/ingresar_reunion', 'ReunionController@CrearReunion');
//------------->Reuniones