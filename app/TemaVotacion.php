<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TemaVotacion extends Model
{
    protected $table="tema_votacion";

    protected function crear($r)
    {
        //dd($r->titulo);
        $tv = $this;
        $tv->titulo = $r->titulo;
        $tv->detalle = $r->detalle;
        $tv->fecha = $r->fecha_ingreso;
        $tv->hora = $r->hora_ingreso;
        $tv->user_crea = Auth::user()->id;
        $tv->estado_tema = 1;//abierta
        $tv->estado_votacion = 1;//abierta
        $tv->activo ='S';

        if ($tv->save()) {
            return ['estado'=>'success','mensaje'=>'Tema creado con exito!'];
        }
        return['estado'=>'failed','mensaje'=>'No se ha podido crear el tema, intente nuevamente'];
    }

    protected function listar()
    {
        $tv = DB::select("SELECT
                            id,
                            titulo,
                            detalle,
                            to_char(fecha, 'dd/mm/yyyy') fecha,
                            hora,
                            estado_votacion,
                            case 
                                when estado_votacion = 1 then 'ABIERTA'
                                when estado_votacion = 2 then 'APROBADA'
                                when estado_votacion = 3 then 'RECHAZADA'
                                when estado_votacion = 4 then 'ABSTENCION'
                            END AS votacion,
                            estado_tema,
                            case 
                                when estado_tema = 1 then 'ABIERTA'
                                when estado_tema = 2 then 'CERRADA'
                            
                            END AS tema
                        from tema_votacion ORDER BY CREATED_AT desc");
        if (count($tv)>0) {
            return ['estado'=>'success', 'tabla'=>$tv];
        }
        return ['estado'=>'failed', 'tabla'=>null];
    }
}
