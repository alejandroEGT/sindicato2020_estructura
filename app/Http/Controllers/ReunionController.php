<?php

namespace App\Http\Controllers;

use App\Reunion;
use Illuminate\Http\Request;

class ReunionController extends Controller
{
    public function CrearReunion(Request $request)
    {
        return Reunion::crearReunion($request);
    }

    public function TraerReuniones()
    {
        return Reunion::traerReuniones();
    }
}
