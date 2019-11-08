<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function IngresarProveedor(Request $request)
    {
        return Proveedor::ingresarProveedor($request);
    }
}
