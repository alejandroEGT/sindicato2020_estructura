<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiquidacionDetalle extends Model
{
    protected $table = "liq_detalle_haberes_descuentos_empleado";

    protected function guardar($r, $empleado)
    {
        $verify = $this->where([
            'activo'=>'S',
            'empleado_id'=>$empleado,
            'liquidacion_id'=> $r->liquidacion_id,
            'liq_detalle_haberes_descuentos_id'=>$r->id_h_d
        ])->first();

        //dd($verify);

        if ($verify) {

            $verify->monto = $r->monto;
            if ($verify->save()) {
                return true;
            }
            return false;
        }else{
             $l = $this;
            $l->liquidacion_id = $r->liquidacion_id;
            $l->liq_detalle_haberes_descuentos_id = $r->id_h_d;
            $l->empleado_id = $empleado;
            $l->monto = $r->monto;
            $l->activo = 'S';
            if ($l->save()) {

              
                return true;
            }
        }


       

      
    }
}
