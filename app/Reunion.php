<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reunion extends Model
{
    protected $table = "reuniones";

    protected function crearReunion($request)
    {
        $reunion = new Reunion;
        $reunion->fecha_inicio = $request->fecha;
        $reunion->estado_reunion_id = 1;
        $reunion->titulo = $request->titulo;
        $reunion->cuerpo = $request->cuerpo;
        $reunion->user_id = Auth::user()->id;
        $reunion->activo = 'S';
        if ($reunion->save()) {
            return ['estado' => 'success', 'mensaje' => 'Reunion creada Correctamente.'];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'A ocurrido un error, intenta nuevamente.'];
        }
    }

    protected function traerReuniones()
    {
        $reuniones = DB::table('reuniones as r')
            ->select([
                'r.id',
                'r.fecha_incio',
                'r.titulo',
                'u.name'
            ])
            ->join('users as u', 'u.id', 'r.user_id')
            ->get();
        if (!$reuniones->isEmpty()) {
            return ['estado' => 'success', 'reuniones' => $reuniones];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'No se encuentran reuniones creadas.'];
        }
    }
}
