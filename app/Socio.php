<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table = 'socios';

    protected function insertar($r)
    {
        $user = User::insertar($r);
        if ($user['estado'] == true) {
            $s = $this;
            $s->nombres = $r->nombres;
            $s->apellidos = $r->apellidos;
            $s->rut = $r->rut;
            $s->fecha_nacimiento = $r->fecha_nacimiento;
            $s->fecha_ingreso = $r->fecha_ingreso;
            $s->activo = 'S';
            $s->user_id = $user['user']->id;

            if ($s->save()) {
                return[
                    'estado' => 'success',
                    'mensaje'=> 'Socio ingresado'
                ];
            }else{
                return[
                    'estado' => 'failed',
                    'mensaje'=> 'No se ha podido ingresar el socio'
                ];
            }
        }
    }

    protected function listar($b='')
    {
        if ($b=='') {
            $buscar='%%';//traer todo
        }else{
            $buscar = strtoupper($b);
        }

        

        $tabla = DB::select("SELECT
                                s.id socio_id,
                                user_id,
                                upper(nombres) nombres,
                                upper(apellidos) apellidos,
                                rut,
                                email,
                                fecha_nacimiento,
                                fecha_ingreso,
                                fecha_egreso
                            from socios s
                            inner join users u on s.user_id = u.id where s.activo = 'S' 
                            and upper(concat(nombres,' ',apellidos)) like '%$buscar%'
                            order by apellidos asc

        ") ;

        if (count($tabla)> 0) {
            return [
                'estado' => 'success',
                'tabla' => $tabla
            ];
        }
        return [
                'estado' => 'failed',
                'tabla' => []
            ];
    }
    

     protected function listar_s($b='')
    {
        if ($b=='') {
            $buscar='%%';//traer todo
        }else{
            $buscar = strtoupper($b);
        }

        

        $tabla = DB::select("SELECT
                                s.id socio_id,
                                user_id,
                                upper(nombres) nombres,
                                upper(apellidos) apellidos,
                                rut,
                                email,
                                fecha_nacimiento,
                                fecha_ingreso,
                                fecha_egreso
                            from socios s
                            inner join users u on s.user_id = u.id where s.activo = 'S' 
                            and (upper(concat(nombres,' ',apellidos)) = '$buscar' or rut = '$buscar')
                            order by apellidos asc") ;

        if (count($tabla)> 0) {
            return [
                'estado' => 'success',
                'tabla' => $tabla[0]
            ];
        }
        return [
                'estado' => 'failed',
                'tabla' => []
            ];
    }
}
