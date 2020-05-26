<?php

namespace App\Http\Controllers;

use App\Votaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotarController extends Controller
{
    public function votar(Request $r)
    {
        
        $verify = Votaciones::where([
            'tema_votacion_id'=> $r->tema_votacion_id,
            'socio_id' => Auth::user()->id
        ])->first();

        if ($verify) {
            return ['estado'=>'failed', 'mensaje'=> 'Ya no puedes cambiar el voto'];
        }else{

            $v = new Votaciones;
            $v->tema_votacion_id = $r->tema_votacion_id;
            $v->socio_id = Auth::user()->id;
            $v->votacion = $r->voto;
            if ($v->save()) {
                return ['estado'=>'success', 'mensaje'=>'Has votado con exito!'];
            }
            return ['estado'=>'failed','mensaje'=>'No se ha podido votar'];
        }
    }
    public function obtener_votos($tema)
    {
        $a = Votaciones::where([
            'tema_votacion_id' => $tema,
            'votacion'=>'A'
        ])->count();
        $r = Votaciones::where([
            'tema_votacion_id' => $tema,
            'votacion'=>'R'
        ])->count();
        $ma = Votaciones::where([
            'tema_votacion_id' => $tema,
            'votacion'=>'MA'
        ])->count();

        return [
            'labels' => [
                        'Apruebo: '.$a,
                        'Rechazo: '.$r,
                        'Me abstengo: '.$ma,
                        'nulo: '.(10)
                       
            ],
            'datasets' =>[
               
                [
                    'label' => 'Ocupaciones',
                    'backgroundColor' => ['#58D68D','#EC7063'],
                    'data' => [ 
                                $a, $r, $ma, 10
                               ]
                ]
            ]
            
        ];
    }
}
