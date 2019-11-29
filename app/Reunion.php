<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $table = "reuniones";

    protected function crearReunion($request)
    {
        $fecha = $request->fecha . ' ' . $request->hora;
        $reunion = new Reunion;
        $reunion->fecha_inicio = $fecha;
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
                'r.fecha_inicio',
                'r.titulo',
                /* 'r.cuerpo', */
                DB::raw('initcap(u.name) as creada_por'),/* initcap */
                'r.created_at'
            ])
            ->join('users as u', 'u.id', 'r.user_id')
            ->get();
        if (!$reuniones->isEmpty()) {
            Carbon::setLocale('es');
            foreach ($reuniones as $key) {
                $fecha = ucwords(Carbon::parse($key->created_at)->diffForHumans());
                $key->created_at = $fecha;
            }
            return ['estado' => 'success', 'reuniones' => $reuniones];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'No se encuentran reuniones creadas.'];
        }
    }
}
