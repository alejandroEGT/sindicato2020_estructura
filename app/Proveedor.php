<?php

namespace App;

use Illuminate\Support\Facades\DB;
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
            $proveedor->contacto = $request->contacto;
            $proveedor->procedencia = $request->procedencia;
            $proveedor->detraccion = $request->detraccion;
            $proveedor->rut = $limpiar;
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

    protected function traerProveedores()
    {
        $prov = DB::table('proveedores as p')
            ->select([
                'p.id',
                'p.codigo',
                'p.razon_social',
                'p.direccion',
                'p.ubicacion',
                'p.telefono',
                'p.correo',
                'p.pagina_web as pagina',
                'p.contacto',
                'p.rut',
                DB::raw("concat(p.detraccion, '%') as detraccion"),
                'p.activo',
                'g.descripcion as giro',
                'pro.descripcion as procedencia',
                't.descripcion as tipo'
            ])
            ->join('giros as g', 'g.id', 'p.giro')
            ->join('procedencia as pro', 'pro.id', 'p.procedencia')
            ->join('tipo as t', 't.id', 'p.tipo_proveedor')
            ->get();

        if (!$prov->isEmpty()) {
            return ['estado' => 'success', 'proveedores' => $prov];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'No se encuentran Proveedores ingresados.'];
        }
    }

    protected function traerProcedencia()
    {
        $proc = DB::table('procedencia')
            ->select([
                'id',
                'descripcion'
            ])
            ->where([
                'activo' => 'S'
            ])
            ->get();

        return $proc;
    }

    protected function traerGiros()
    {
        $giros = DB::table('giros')
            ->select([
                'id',
                'descripcion'
            ])
            ->where([
                'activo' => 'S'
            ])
            ->get();

        return $giros;
    }

    protected function traerTipos()
    {
        $tipos = DB::table('tipo')
            ->select([
                'id',
                'descripcion'
            ])
            ->where([
                'activo' => 'S'
            ])
            ->get();

        return $tipos;
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
