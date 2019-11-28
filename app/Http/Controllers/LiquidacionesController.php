<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionesController extends Controller
{
    public function select_nombre()
    {
        $select = DB::select("SELECT
                                 id, concat(nombres,' ',apellido_paterno,' ',apellido_materno) nombre 
                            from cliente");

        if(count($select)>0){
            return $select;
        }
    }
    public function traer_datos_persona($id)
    {
        $datos = DB::select("SELECT id, concat(nombres,' ',apellido_paterno,' ',apellido_materno) nombre, rut, fecha_nacimiento
                                FROM cliente where id = $id and activo = 'S'
                            ");
        if (count($datos) > 0) {
            return response()->json($datos[0]);
        }
    }
}
