<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function validar_datos_cliente($request)
    {
        $validator = Validator::make(
             $request->all(),
             [
                'fecha_nacimiento' => 'required',
                'rut' => 'required|min:2|max:20|unique:cliente,rut',
                'nombres' => 'required|min:3|max:50',
                'apellido_materno' => 'required|min:3|max:50',
                'apellido_paterno' => 'required|min:3|max:50',
            ],
             [
                'fecha_nacimiento.required' => 'La fecha es necesaria',
                'rut.required' => 'El rut es necesario',
                'rut.unique' => 'El rut del cliente ya existe en los registros',
                'rut.min' => 'El rut debe tener un minimo de 2 caracteres.',
                'rut.max' => 'El rut no puede tener más de 20 caracteres.',
                'nombres.required' => 'El nombre es necesario',
                'nombres.min' => 'El nombre debe tener un minimo de 3 caracteres.',
                'nombres.max' => 'El nombre no puede tener más de 50 caracteres.',
                'apellido_paterno.required' => 'El apellido paterno es necesario',
                'apellido_paterno.min' => 'El apellido paterno debe tener un minimo de 3 caracteres.',
                'apellido_paterno.max' => 'El apellido paterno no puede tener más de 50 caracteres.',
                'apellido_materno.required' => 'El apellido materno es necesario',
                'apellido_materno.min' => 'El apellido materno debe tener un minimo de 3 caracteres..',
                'apellido_materno.max' => 'El apellido materno no puede tener más de 50 caracteres.',
            ]
         );

 
        if ($validator->fails()) {
            return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
        }
        return ['estado' => 'success', 'mensaje' => 'success'];
    }

    public function crear_cliente(Request $datos)
    {
        $validador = $this->validar_datos_cliente($datos);

        if ($validador['estado'] == 'success') {
            $registrar =  Cliente::registro_cliente($datos);
        
            if ($registrar) {
                return ['estado'=>'success', 'mensaje'=>'Cliente ingresado correctamente.'];
            }
                return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
        } else {
            return $validador;
        }
    }

    public function listar_cliente()
    {
        $listar = Cliente::traer_cliente();

        if ($listar['respuesta'] == true) {
            return ['estado'=>'success', $listar['listar']];
        }
        return ['estado'=>'failed', 'mensaje'=>'Aun no existen datos para mostrar.'];
    }

    public function actualizar_campo_cliente(Request $datos){
        return Cliente::modificar_campo_cliente($datos);
    }
}
