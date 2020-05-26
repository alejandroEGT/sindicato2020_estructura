<?php

namespace App\Http\Controllers;

use App\TemaVotacion;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function insertar_tema_votacion(Request $r)
    {
        $tv = TemaVotacion::crear($r);
        return $tv;
    }

    public function listar_tema_votacion()
    {
        return TemaVotacion::listar();
    }
}
