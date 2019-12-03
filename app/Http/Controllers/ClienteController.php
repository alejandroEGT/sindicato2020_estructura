<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DeudasCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function crear_cliente(Request $datos){
       return Cliente::registro_cliente($datos);
    }

    public function listar_cliente(){
        return Cliente::traer_cliente();
    }

    public function actualizar_campo_cliente(Request $datos){
        return Cliente::modificar_campo_cliente($datos);
    }
    
    public function eliminar_cliente(Request $datos){
        return Cliente::eliminar_cliente($datos);
    }
    
    public function traer_clientes_deudas(){
        return Cliente::traer_clientes_deudas();
    }
    
    public function traer_tipo_deuda(){
        return Cliente::traer_tipo_deuda();
    }
    
    public function registro_cliente_deudas(Request $datos){
        return DeudasCliente::registro_cliente_deudas($datos);
    }
    
    public function buscar_cliente($rut){
        return DeudasCliente::buscar_cliente($rut);
    }
    public function deudas_cliente($id){
        return DeudasCliente::deudas_cliente($id);
    }
    public function modificar_campo_deuda(Request $datos){
        return DeudasCliente::modificar_campo_deuda($datos);
    }
}
