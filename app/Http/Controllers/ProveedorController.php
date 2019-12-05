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

    public function TraerProveedores()
    {
        return Proveedor::traerProveedores();
    }

    public function VerProveedor($id)
    {
        return Proveedor::verProveedor($id);
    }

    public function TraerGiros()
    {
        return Proveedor::traerGiros();
    }

    public function TraerEstados()
    {
        return Proveedor::traerEstados();
    }
}
