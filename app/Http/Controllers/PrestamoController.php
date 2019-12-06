<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DetallePrestamo;
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
                'cuotas' => 'required',
                'totalInteres' => 'required',
                'fecha' => 'required',
                'idCliente' => 'required',
                'idTipo' => 'required'
            ],
            [
                'montoSolicitado.required' => 'El monto es necesario',
                'cuotas.required' => 'El numero de cuotas es necesario',
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
            $prestamo->monto_solicitado = $request->montoSolicitado;
            $prestamo->cuotas = $request->cuotas;
            $prestamo->total_interes = $request->totalInteres;
            $prestamo->fecha = $request->fecha;
            $prestamo->cliente_id = $request->idCliente;
            $prestamo->usuario_id = Auth::user()->id;
            $prestamo->tipo_id = $request->idTipo;
            $prestamo->estado = 'Vigente';
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

    public function setPagoPrestamo(Request $request)
    {

        //Verificar si existe detalle del prestamo
        $consultaDetalle = DetallePrestamo::where([
            'prestamo_id' => $request->idPrestamo,
            'activo' => 'S'
        ])
            ->count();
        //Definir el numero de cuota en el detalle
        if ($consultaDetalle == 0) {
            $cuota = $consultaDetalle + 1;
            $estado = 'Vigente';
        } else {
            $cuota = $consultaDetalle + 1;
            $estado = 'Vigente';
        }
        
        //obtener el numero de cuotas del prestamo
        $numeroCuotasPrestamo = Prestamo::select(
            'cuotas',
            'total_interes'
        )
            ->where([
                'id' => $request->idPrestamo
            ])
            ->first();

        //verificar los montos a pagar del prestamo con los detalles
        $sumaDetalles = DetallePrestamo::where([
            'prestamo_id' => $request->idPrestamo
        ])
            ->sum('monto');

        //monto que falta por pagar
        $totalRestantePorPagar = $numeroCuotasPrestamo->total_interes - $sumaDetalles;

        if ($cuota == $numeroCuotasPrestamo->cuotas && $request->monto != $totalRestantePorPagar) {
            return ['estado' => 'failed', 'mensaje' => 'El monto de la cuota final debe de cubir toda la deuda faltante.'];
        } else {
            if ($cuota <= $numeroCuotasPrestamo->cuotas) {
                $pagoPrestamo = new DetallePrestamo;
                $pagoPrestamo->fecha = $request->fecha;
                $pagoPrestamo->cuota = $cuota;
                $pagoPrestamo->monto = $request->monto;
                $pagoPrestamo->estado = $estado;
                $pagoPrestamo->prestamo_id = $request->idPrestamo;
                $pagoPrestamo->activo = 'S';
                if ($pagoPrestamo->save()) {
                    if($cuota == $numeroCuotasPrestamo->cuotas || $totalRestantePorPagar == $request->monto){
                        $terminarPrestamo = Prestamo::find($request->idPrestamo);
                        $terminarPrestamo->estado = 'Pagado';
                        $terminarPrestamo->save();
                    }
                    return ['estado' => 'success', 'mensaje' => 'Cuota de prestamo pagado correctamente'];
                } else {
                    return ['estado' => 'failed', 'mensaje' => 'Se ha producido un error intentar nuevamente.'];
                }
            } else {
                return ['estado' => 'failed', 'mensaje' => 'Ya se ha pagado el numero de cuotas correspondiente al prestamo.'];
            }
        }
    }

    public function getPrestamoPorCliente($id)
    {
        return Prestamo::select(
            'id',
            'monto_solicitado',
            'total_interes',
            'fecha',
            'cliente_id',
            'usuario_id',
            'tipo_id',
            'cuotas',
            'estado'
        )
            ->where([
                'cliente_id' => $id,
                'estado' => 'Vigente'
            ])
            ->get();
    }

    public function getDetallePrestamosPorPrestamo($id){
        $cuotasPagadas = DetallePrestamo::select(
            'fecha',
            'cuota',
            'monto'
        )
        ->where([
            'prestamo_id' => $id,
            'activo' => 'S'
        ])->get();

        $totalCuotas = Prestamo::where([
            'id' => $id,
            'activo' => 'S'
        ])
        ->first();

        $restante = $this->obtenerRestanteFuncion($id);

        return ['estado' => 'success', 'cuotasPagadas' => $cuotasPagadas, 'totalCuotas' => $totalCuotas->cuotas, 'restante' => $restante];
    }

    public function getPrestamosTodos()
    {
        return Prestamo::all();
    }

    public function getPrestamosPorTipo($id)
    {
        return Prestamo::select('monto_solicitado', 'total_interes', 'fecha', 'cliente_id', 'usuario_id', 'tipo_id')
            ->where('tipo_id', $id)
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

    public function obtenerRestanteFuncion($id){
        //obtener el numero de cuotas del prestamo
        $numeroCuotasPrestamo = Prestamo::select(
            'cuotas',
            'total_interes'
        )
            ->where([
                'id' => $id
            ])
            ->first();

        //verificar los montos a pagar del prestamo con los detalles
        $sumaDetalles = DetallePrestamo::where([
            'prestamo_id' => $id
        ])
            ->sum('monto');

        //monto que falta por pagar
        return $numeroCuotasPrestamo->total_interes - $sumaDetalles;
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
