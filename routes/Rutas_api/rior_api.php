<?php
//RUTAS PARA LOS PRESTAMOS
Route::post('setPrestamo', 'PrestamoController@setPrestamo');
Route::get('getPrestamos', 'PrestamoController@getPrestamosTodos');
Route::get('getPrestamosPorTipo', 'PrestamoController@getPrestamosPorTipo');
Route::get('getDetallePrestamosPorPrestamo/{id}', 'PrestamoController@getDetallePrestamosPorPrestamo');
Route::get('getPrestamoPorCliente/{id}', 'PrestamoController@getPrestamoPorCliente');
Route::post('setPagoPrestamo', 'PrestamoController@setPagoPrestamo');

//RUTA PARA OBTENER EL CLIENTE
Route::get('getClientePrestamo/{rut}', 'PrestamoController@getClientePorRut');