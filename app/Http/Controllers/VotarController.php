<?php

namespace App\Http\Controllers;

use App\User;
use App\Votaciones;
use App\TemaVotacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotarController extends Controller
{
    public function votar(Request $r)
    {
        $tv = TemaVotacion::find($r->tema_votacion_id);
        if ($tv->estado_tema == 2) {
            return [
                'estado' => 'failed',
                'mensaje' => 'Tema ya cerrado'
            ];
        }

        
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

        $socios = User::where('rol','2')
                    ->orWhere('rol','3')
                    ->count();  
        
        $null = $socios - $a - $r - $ma;

        return [
            'labels' => [
                        'Apruebo: '.$a,
                        'Rechazo: '.$r,
                        'Me abstengo: '.$ma,
                        'nulo: '.($null)
                       
            ],
            'datasets' =>[
               
                [
                    'label' => 'Ocupaciones',
                    'backgroundColor' => ['#58D68D','#EC7063', '#7F8C8D'],
                    'data' => [ 
                                $a, $r, $ma, $null
                               ]
                ]
            ]
            
        ];
    }

    public function obtener_votos_2($tema)
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

        $socios = User::where('rol','2')
                    ->orWhere('rol','3')
                    ->count();  
        
        $null = $socios - $a - $r - $ma;

        return [
            'apruebo' => $a,
            'rechazo' => $r,
            'abstengo' => $ma,
            'nulo' => $null,
            'socios' => $socios 
        ];

    }

    public function finalizar_tema(Request $r)
    {
        
        $v = TemaVotacion::find($r->id);
        $v->estado_tema = 2; // cerrar tema
        $v->estado_votacion = $r->estado_voto;
        if ($v->save()) {
            return [
                'estado' => 'success',
                'mensaje' => 'Tema finalizado'
            ];
        }

        return [
                'estado' => 'failed',
                'mensaje' => 'No se ha podido cerrar el tema'
            ];

    }
}
