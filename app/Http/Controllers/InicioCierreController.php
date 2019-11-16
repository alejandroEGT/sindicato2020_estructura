<?php

namespace App\Http\Controllers;

use App\Cuentadescripcion;
use App\InicioCierreMensual;
use Illuminate\Http\Request;

class InicioCierreController extends Controller
{
    public function ingresar(Request $r)
    {
        $exist = InicioCierreMensual::where([
            'cuenta_id' => $r->cuenta_id,
            'mes'=>$r->mes,
            'anio'=>$r->anio
        ])->first();

        if (!$exist) {
            $cd = new InicioCierreMensual;
            $cd->cuenta_id = $r->cuenta_id;
            $cd->mes = $r->mes;
            $cd->anio = $r->anio;
            $cd->inicio_mensual = $r->monto_inicio;
            $cd->activo = 'S';
            if ($cd->save()) {
                return ['estado'=>'success','mensaje'=>'Inicio mensual ingresado'];
            }
            return ['estado'=>'failed','mensaje'=>'Error al ingresar'];
        }else{
            $exist->inicio_mensual = $r->monto_inicio;
            if ($exist->save()) {
                return ['estado'=>'success','mensaje'=>'Inicio mensual actualizado'];
            }
            return ['estado'=>'failed','mensaje'=>'Error al actualizar'];
        }
    }

    public function traer_inicio_mensual($mes, $anio, $cuenta_id)
    {
        $dato = InicioCierreMensual::where([
            'cuenta_id' => $cuenta_id,
            'mes'=>$mes,
            'anio'=>$anio
        ])->first();

        if ($dato) {
            return ['estado'=>'success','inicio_mensual'=>$dato->inicio_mensual];
        }
    }
}
