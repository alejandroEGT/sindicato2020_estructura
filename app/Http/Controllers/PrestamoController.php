<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Prestamo;
use App\TipoPrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PrestamoController extends Controller
{
    //RELACION
    public function tipoPrestamo()
    {
        return $this->belongsTo(TipoPrestamo::class, 'idTipo');
    }

    //VALIDADOR DE CAMPOS
    public function validarDatosPrestamo($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'montoSolicitado' => 'required',
                'totalInteres' => 'required',
                'fecha' => 'required',
                'idCliente' => 'required',
                'idTipo' => 'required'
            ],
            [
                'montoSolicitado.required' => 'El monto es necesario',
                'totalInteres.required' => 'El valor del interes es necesario',
                'fecha.required' => 'debe de ingresar una fecha',
                'idCliente.required' => 'No se ha encontrado el identificador del usuario',
                'idTipo.required' => 'Debe de seleccionar si el prestamo es con o sin interes'
            ]
        );
        if ($validator->fails()) {
            return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
        }
        return ['estado' => 'success', 'mensaje' => 'success'];
    }

    //FUNCIONES PARA LOS PRESTAMOS EN SI
    public function setPrestamo(Request $request)
    {
        //validar campos obtenidos
        $validador = $this->validarDatosPrestamo($request);
        if ($validador['estado'] == 'success') {
            //ingresar el nuevo prestamo
            $prestamo = new Prestamo;
            $prestamo->montoSolicitado = $request->montoSolicitado;
            $prestamo->totalInteres = $request->totalInteres;
            $prestamo->fecha = $request->fecha;
            $prestamo->idCliente = $request->idCliente;
            $prestamo->idUsuario = Auth::user()->id;
            $prestamo->idTipo = $request->idTipo;
            $prestamo->activo = 'S';
            if ($prestamo->save()) {
                return ['estado' => 'success', 'mensaje' => 'Prestamo ingresado correctamente'];
            } else {
                return ['estado' => 'failed', 'mensaje' => 'Se ha producido un error intentar nuevamente.'];
            }
        } else {
            return $validador;
        }
    }

    public function getPrestamosTodos()
    {
        return Prestamo::all();
    }

    public function getPrestamosPorTipo($id)
    {
        return Prestamo::select('montoSolicitado', 'totalInteres', 'fecha', 'idCliente', 'idUsuario', 'idTipo')
            ->where('idTipo', $id)
            ->get();
    }

    //FUNCION PARA OBTENER UN CLIENTE EN ESPECIFICO
    public function getClientePorRut($rut)
    {
        $limpiar = $this->limpiarRut($rut);
        $validarRut = $this->validarRut($limpiar);
        if ($validarRut == true) {
            $busqueda = Cliente::select([
                'id',
                'fecha_nacimiento',
                DB::raw("INITCAP(concat(nombres,' ', apellido_paterno, ' ', apellido_materno)) as nombreCliente")
            ])
                ->where('rut', $limpiar)
                ->get();
            if (count($busqueda) > 0) {
                return ['estado' => 'success', 'cliente' => $busqueda[0]];
            } else {
                return ['estado' => 'failed_unr', 'mensaje' => 'El rut ingresado no existe en nuestros registros.'];
            }
        } else {
            return ['estado' => 'failed', 'mensaje' => 'El rut ingresado no es valido.'];
        }
    }

    //FUNCION PARA LIMPIAR EL RUT
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
