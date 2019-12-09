<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table = "empleados";

    protected function insertar($r)
    {
        $e =$this;

        $e->nombres = $r->nombre;
        $e->apellido_paterno = $r->apellido_paterno;
        $e->apellido_materno = $r->apellido_materno;
        $e->rut = $r->rut;
        $e->direccion = $r->direccion;
        $e->telefono = $r->telefono;
        $e->fecha_contrato = $r->fecha_contrato;
        $e->departamento_id = $r->departamento['id'];
        $e->cargo_id = $r->categoria['id'];
        $e->puesto_trabajo = $r->puesto_trabajo;
        $e->activo='S';

        if ($e->save()) {
            return [
                'estado'=>'success',
                'mensaje'=>'Empleado Ingresado'
            ];
        }
        return[
            'estado'=>'failed',
            'mensaje'=>'Error al ingresar'
        ];
    }
}
