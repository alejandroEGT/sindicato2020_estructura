<?php

namespace App;

use App\ContactoProv;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected function ingresarProveedor($request)
    {
        $limpiar = $this->limpiarRut($request->rut);
        $validarRut = $this->validarRut($limpiar);
        if ($validarRut == true) {
            $proveedor = new Proveedor;
            DB::beginTransaction();
            $proveedor->codigo = $request->codigo;
            $proveedor->rut = $limpiar;
            $proveedor->razon_social = $request->razon_social;
            $proveedor->telefono = $request->fono_emp;
            $proveedor->correo = $request->correo_emp;
            $proveedor->pagina_web = $request->pagina;
            $proveedor->giro_prov_id = $request->giro;
            $proveedor->direccion = $request->direccion;
            $proveedor->ciudad = $request->ciudad;
            $proveedor->estado_prov_id = 1;
            $proveedor->activo = 'S';
            /* dd($proveedor); */
            if ($proveedor->save()) {
                $contacto = ContactoProv::ingresarContactoProv($proveedor->id, $request->nombres, $request->apellidos, $request->fono_con, $request->correo_con);
                if ($contacto == true) {
                    DB::commit();
                    return ['estado' => 'success', 'mensaje' => 'Proveedor ingresado correctamente.'];
                } else {
                    DB::rollBack();
                    return ['estado' => 'failed', 'mensaje' => 'A ocurrido un error, intenta nuevamente.'];
                }
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
                'p.rut',
                'p.razon_social',
                'p.telefono',
                'p.correo',
                'p.pagina_web',
                'p.direccion',
                'p.ciudad',
                'g.descripcion as giro',
                'ep.descripcion as estado'

            ])
            ->join('giros_prov as g', 'g.id', 'p.giro_prov_id')
            ->join('estado_prov as ep', 'ep.id', 'p.estado_prov_id')
            ->get();

        if (!$prov->isEmpty()) {
            return ['estado' => 'success', 'proveedores' => $prov];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'No se encuentran Proveedores ingresados.'];
        }
    }

    protected function verProveedor($id)
    {
        $prov = DB::table('proveedores as p')
            ->select([
                'p.id',
                'p.codigo',
                'p.rut',
                'p.razon_social',
                'p.telefono',
                'p.correo',
                'p.pagina_web',
                'p.direccion',
                'p.ciudad',
                'p.giro_prov_id',
                'g.descripcion'
            ])
            ->join('giros_prov as g', 'g.id', 'p.giro_prov_id')
            ->where([
                'p.activo' => 'S',
                'p.id' => $id
            ])
            ->get();

        if (!$prov->isEmpty()) {
            return ['estado' => 'success', 'proveedor' => $prov[0]];
        } else {
            return ['estado' => 'failed', 'mensaje' => 'No se encuentra el Proveedor.'];
        }
    }

    protected function traerGiros()
    {
        $giros = DB::table('giros_prov')
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

    protected function traerEstados()
    {
        $estados = DB::table('estado_prov')
            ->select([
                'id',
                'descripcion'
            ])
            ->where([
                'activo' => 'S'
            ])
            ->get();

        return $estados;
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
        $rut = str_replace('k', 'K', $rut);

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
