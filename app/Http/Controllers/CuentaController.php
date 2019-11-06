<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function crear(Request $r)
    {
    	$c = new Cuenta;
    	$c->titulo = $r->nombre;
    	$c->descripcion = $r->descripcion;
    	$c->activo = 'S';
    	if ($c->save()) {
    		return ['estado'=>'success', 'mensaje'=>'Cuenta ingresada'];
    	}
    }
}
