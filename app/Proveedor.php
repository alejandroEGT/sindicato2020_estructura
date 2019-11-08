<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected function ingresarProveedor($request)
    {
        $proveedor = new Proveedor;
        $limpiar = $this->limpiarRut($request->rut);
        $validarRut = $this->validarRut($limpiar);
        if ($validarRut == true) {
            $proveedor->codigo = $request->codigo;
            $proveedor->razon_social = $request->razon_social;
            $proveedor->direccion = $request->direccion;
            $proveedor->ubicacion = $request->ubicacion;
            $proveedor->telefono = $request->telefono;
            $proveedor->correo = $request->correo;
            $proveedor->pagina_web = $request->pagina;
            $proveedor->giro = $request->giro;
            $proveedor->flujo = $request->flujo;
            $proveedor->contacto = $request->contacto;
            $proveedor->procedencia = $request->procedencia;
            $proveedor->declarante = $request->declarante;
            $proveedor->detraccion = $request->detraccion;
            $proveedor->rut = $limpiar;
            $proveedor->fecha_vencimiento = $request->fecha_vencimiento;
            $proveedor->agente_rete = $request->agente_rete;
            $proveedor->tipo_proveedor = $request->tipo;
            $proveedor->activo = 'S';
            if ($proveedor->save()) {
                return ['estado' => 'success', 'mensaje' => 'Proveedor ingresado correctamente.'];
            } else {
                return ['estado' => 'failed', 'mensaje' => 'A ocurrido un error, intenta nuevamente.'];
            }
        } else {
            return ['estado' => 'failed', 'mensaje' => 'El rut ingresado no es valido.'];
        }
    }

    protected function validarRut($rut)
    {
        try {
            $rut = preg_replace('/[^k0-9]/i', '', $rut);
            $dv  = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut) - 1);
            $i = 2;
            $suma = 0;
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i == 8)
                    $i = 2;
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);

            if ($dvr == 11)
                $dvr = 0;
            if ($dvr == 10)
                $dvr = 'K';
            if ($dvr == strtoupper($dv))
                return true;
            else
                return false;
        } catch (\Exception $e) {
            return ['status' => 'failed', 'Se ha producido un error, verifique si el rut es correcto o existe en la base de datos'];
        }
    }

    protected function limpiarRut($rut)
    {
        $rut = str_replace('á', 'a', $rut);
        $rut = str_replace('Á', 'A', $rut);
        $rut = str_replace('é', 'e', $rut);
        $rut = str_replace('É', 'E', $rut);
        $rut = str_replace('í', 'i', $rut);
        $rut = str_replace('Í', 'I', $rut);
        $rut = str_replace('ó', 'o', $rut);
        $rut = str_replace('Ó', 'O', $rut);
        $rut = str_replace('Ú', 'U', $rut);
        $rut = str_replace('ú', 'u', $rut);

        //Quitando Caracteres Especiales 
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);
        $rut = str_replace('-', '', $rut);
        return $rut;
    }
}
