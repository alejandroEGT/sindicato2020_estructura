<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function insertar(Request $r)
    {
        
        $e = Empleados::insertar($r);
        return $e;
    }
}
