<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class DeudasCliente extends Model
{
    protected $table = 'deudas_cliente';


    public function validar_datos_cliente_deudas($datos)
    {
        $validator = Validator::make(
             $datos->all(),
             [
                'cliente_id' => 'required',
                'tipo_deuda_id' => 'required',
                'monto' => 'required|min:1|max:50',
                'descripcion' => 'required|min:3|max:500',
                'fecha' => 'required',
            ],
             [
                'cliente_id.required' => 'Debe selecionar un Cliente',
                'tipo_deuda_id.required' => 'Debe seleccionar un tipo de deuda',
                'monto.required' => 'El monto es necesario',
                'monto.min' => 'El monto debe tener un minimo de 1 caracter.',
                'monto.max' => 'El monto no puede tener más de 50 caracteres.',
                'descripcion.required' => 'La descripcion es necesaria',
                'descripcion.min' => 'La descripcion debe tener un minimo de 3 caracteres.',
                'descripcion.max' => 'La descripcion no puede tener más de 500 caracteres.',
                'fecha.required' => 'La fecha es necesaria',

                
            ]
         );

 
        if ($validator->fails()) {
            return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
        }
        return ['estado' => 'success', 'mensaje' => 'success'];
    }

    protected function registro_cliente_deudas($datos)
    {
        $validarDatos = $this->validar_datos_cliente_deudas($datos);

        if ($validarDatos['estado'] == 'success') {
            $r = $this;
            $r->cliente_id = $datos->cliente_id;
            $r->tipo_deuda_id = $datos->tipo_deuda_id;
            $r->monto=$datos->monto;
            $r->descripcion=$datos->descripcion;
            $r->fecha=$datos->fecha;
            $r->activo='S';

            if ($r->save()) {
                return ['estado'=>'success', 'mensaje'=>'Deuda de cliente guardado con exito.'];
            } else {
                return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error, verifique que los campos esten correctos'];

            }
        }

        return $validarDatos;

    }
    
}
