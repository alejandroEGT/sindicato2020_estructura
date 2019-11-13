<?php

namespace App\Http\Controllers;

use App\Sub_cuenta;
use Illuminate\Http\Request;

class SubcuentaController extends Controller
{
    public function insertar(Request $r)
    {
    	$sc = new Sub_cuenta;
    	$sc->cuenta_id = $r->cuenta_id;
    	$sc->titulo = $r->nombre;
    	$sc->descripcion = $r->descripcion;
    	$sc->activo = 'S';
    	if ($sc->save()) {
    		return ['estado'=>'success','mensaje'=>'Subcuenta ingresada'];
    	}
    	return ['estado'=>'failed','mensaje'=>'Error al ingresar'];

    }

    public function traer_subcuenta($cuenta_id)
    {
    	$list = Sub_cuenta::where('cuenta_id', $cuenta_id)->get();

    	if (count($list) > 0 ) {
    		return ['estado'=>'success', 'lista'=>$list];
    	}
    	return ['estado'=>'failed'];
    }
}
