<?php

namespace App\Http\Controllers;

use App\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function insertar_socio(Request $r)
    {
        return Socio::insertar($r);
    }

    public function listar_socios($b='')
    {
        return Socio::listar($b);
    }
    public function listar_socio($b='')
    {
        return Socio::listar_s($b);
    }

    public function entorno_familiar()
    {
        return [
            ['id'=> '1' ,'nombre'=> 'Conyuge / Pareja'],
            ['id'=> '2' ,'nombre'=> 'Hijo(a)'],
            ['id'=> '3' ,'nombre'=> 'Hijastro'],
            ['id'=> '4' ,'nombre'=> 'Ahijado'],
            ['id'=> '5' ,'nombre'=> 'Padre'],
            ['id'=> '6' ,'nombre'=> 'Madre'],
            ['id'=> '7' ,'nombre'=> 'Suegro'],
            ['id'=> '8' ,'nombre'=> 'Suegra'],
            ['id'=> '9' ,'nombre'=> 'Otros']

        ];
    }
}
