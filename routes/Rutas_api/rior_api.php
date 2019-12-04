<?php
//RUTAS PARA LOS PRESTAMOS
Route::post('setPrestamo', 'PrestamoController@setPrestamo');
Route::get('getPrestamos', 'PrestamoController@getPrestamosTodos');
Route::get('getPrestamosPorTipo', 'PrestamoController@getPrestamosPorTipo');

//RUTA PARA OBTENER EL CLIENTE
Route::get('getClientePrestamo/{rut}', 'PrestamoController@getClientePorRut');