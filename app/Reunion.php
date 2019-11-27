<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

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
}
