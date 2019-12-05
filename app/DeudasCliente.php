<?php

namespace App;

use Carbon\Carbon;
use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DeudasCliente extends Model
{
    protected $table = 'deudas_cliente';

    protected function validarRut($rut)
    {
        try {
            $rut = preg_replace('/[^k0-9]/i', '', $rut);
            $dv  = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut) - 1);
            $i = 2;
            $suma = 0;
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i == 8) {
                    $i = 2;
                }
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);

            if ($dvr == 11) {
                $dvr = 0;
            }
            if ($dvr == 10) {
                $dvr = 'K';
            }
            if ($dvr == strtoupper($dv)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
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

    public function validar_datos_cliente_deudas($datos)
    {
        $validator = Validator::make(
            $datos->all(),
            [
                'cliente_id' => 'required',
                'tipo_deuda_id' => 'required',
                'monto' => 'required|min:1|max:50',
                'descripcion' => 'required|min:3|max:500',
                'fecha' => 'required',
            ],
            [
                'cliente_id.required' => 'Debe selecionar un Cliente',
                'tipo_deuda_id.required' => 'Debe seleccionar un tipo de deuda',
                'monto.required' => 'El monto es necesario',
                'monto.min' => 'El monto debe tener un minimo de 1 caracter.',
                'monto.max' => 'El monto no puede tener más de 50 caracteres.',
                'descripcion.required' => 'La descripcion es necesaria',
                'descripcion.min' => 'La descripcion debe tener un minimo de 3 caracteres.',
                'descripcion.max' => 'La descripcion no puede tener más de 500 caracteres.',
                'fecha.required' => 'La fecha es necesaria',

                
            ]
        );

 
        if ($validator->fails()) {
            return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
        }
        return ['estado' => 'success', 'mensaje' => 'success'];
    }

    protected function registro_cliente_deudas($datos)
    {
        $validarDatos = $this->validar_datos_cliente_deudas($datos);

        if ($validarDatos['estado'] == 'success') {
            $r = $this;
            $r->cliente_id = $datos->cliente_id;
            $r->tipo_deuda_id = $datos->tipo_deuda_id;
            $r->monto=$datos->monto;
            $r->descripcion=$datos->descripcion;
            $r->fecha=$datos->fecha;
            $r->activo='S';
            $r->estado_deuda='NO PAGADO';

            if ($r->save()) {
                return ['estado'=>'success', 'mensaje'=>'Deuda de cliente guardado con exito.'];
            } else {
                return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error, verifique que los campos esten correctos'];
            }
        }
        return $validarDatos;
    }

    protected function buscar_cliente($rut)
    {
        $limpiar = $this->limpiarRut($rut);
        $verificar = $this->validarRut($limpiar);
        if ($verificar == true) {
            $listar = Cliente::select([
                                    'id',
                                    'rut',
                                    DB::raw("INITCAP(concat(nombres ,' ', 
                                    apellido_paterno ,' ', 
                                    apellido_materno)) 
                                    as cliente_deuda")
                           
                                ])
                                    ->where([
                                        'activo'=>'S',
                                        'rut'=>$limpiar
                                    ])
                                    ->get();
        
            if (!$listar->isEmpty()) {
                return ['estado'=>'success' , 'cliente' => $listar[0]];
            } else {
                return ['estado'=>'failed', 'mensaje'=>'El rut ingresado no existe en nuestros registros.'];
            }
        } else {
            return ['estado'=>'failed', 'mensaje'=>'El rut ingresado no es valido.'];
        }
    }

    protected function deudas_cliente($id, $request)
    {
        switch ($request) {

            case 'todos':
                $listarTodos = DeudasCliente::select([
                    'deudas_cliente.id',
                    'deudas_cliente.monto',
                    'deudas_cliente.descripcion',
                    'deudas_cliente.fecha',
                    'deudas_cliente.estado_deuda',
                    'tdc.tipo',
                    'cliente.rut',
                    DB::raw("INITCAP(concat(cliente.nombres ,' ', 
                    cliente.apellido_paterno ,' ', 
                    cliente.apellido_materno)) 
                    as cliente_deuda")
                    ])
                    ->join('tipo_deuda_cliente as tdc', 'tdc.id', 'deudas_cliente.tipo_deuda_id')
                    ->join('cliente', 'cliente.id', 'deudas_cliente.cliente_id')
                    ->orderBy('fecha', 'asc')
                    ->where([
                        'deudas_cliente.activo'=>'S',
                    ])
                    ->get();
                    // ->toSql();


                    if (count($listarTodos) > 0) {
                        foreach ($listarTodos as $key) {
                            $key->fecha = Carbon::parse($key->fecha)->format('d/m/Y');
                        }
                    }
                    if (!$listarTodos->isEmpty()) {
                        return ['estado'=>'success' , 'cliente' => $listarTodos];
                    } else {
                        return ['estado'=>'failed', 'mensaje'=>'No existen clientes con deudas.'];
                    }
                
                break;

            case 'cliente':

                $listar = DeudasCliente::select([
                    'deudas_cliente.id',
                    'deudas_cliente.monto',
                    'deudas_cliente.descripcion',
                    'deudas_cliente.fecha',
                    'deudas_cliente.estado_deuda',
                    'tdc.tipo',
                    'cliente.rut',
                    DB::raw("INITCAP(concat(cliente.nombres ,' ', 
                    cliente.apellido_paterno ,' ', 
                    cliente.apellido_materno)) 
                    as cliente_deuda")
                    ])
                    ->join('tipo_deuda_cliente as tdc', 'tdc.id', 'deudas_cliente.tipo_deuda_id')
                    ->join('cliente', 'cliente.id', 'deudas_cliente.cliente_id')
                    ->orderBy('fecha', 'asc')
                    ->where([
                        'deudas_cliente.activo'=>'S',
                        'deudas_cliente.estado_deuda'=>'NO PAGADO',
                        'deudas_cliente.cliente_id' =>$id
                    ])
                    ->get();

                    if (count($listar) > 0) {
                        foreach ($listar as $key) {
                            $key->fecha = Carbon::parse($key->fecha)->format('d-m-Y');
                        }
                    }
                    if (!$listar->isEmpty()) {
                        return ['estado'=>'success' , 'cliente' => $listar];
                    } else {
                        return ['estado'=>'failed_c', 'mensaje'=>'El cliente no posee deudas vigentes.'];
                    }
                break;
            
            default:
                return null;
                break;
        }
    }

    protected function validar_modificar_campo_deuda($request)
    {
        switch ($request->campo) {
        case 'tipo_deuda_id':
          $validator = Validator::make(
              $request->all(),
              [
              'input' => 'required'
            ],
              [
              'input.required' => 'Debe seleccionar un tipo de deuda.'
            ]
          );
          break;
        
          case 'monto':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:1|max:20'
            ],
                [
              'input.required' => 'Debe ingresar un monto.',
              'input.min' => 'El minimo de caracteres es de 1',
              'input.max' => 'El maximo de caracteres es de 20'
            ]
            );
            break;

          case 'descripcion':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:3|max:80'
            ],
                [
              'input.required' => 'Debe ingresar una descripcion.',
              'input.min' => 'El minimo de caracteres es de 3',
              'input.max' => 'El maximo de caracteres es de 80'
            ]
            );
            break;

          case 'fecha':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:1|max:10'
            ],
                [
              'input.required' => 'Debe ingresar una fecha.',
              'input.min' => 'El minimo de caracteres es de 1',
              'input.max' => 'El maximo de caracteres es de 10'
            ]
            );
            break;

        default:
        return null;
          break;
      }
        if ($validator->fails()) {
            return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
        }
        return ['estado' => 'success', 'mensaje' => 'success'];
    }

    protected function modificar_campo_deuda($request)
    {

        $estadoCliente = DeudasCliente::where([
            'id'=>$request->id,
            'activo'=>'S',
           ])
           ->get();

        if ($estadoCliente[0]->estado_deuda == 'PAGADO') {
            return ['estado'=>'failed_p', 'mensaje'=>'El pago ya fue realizado, no puede modificar ningun campo.'];
        }

        $validarDatos = DeudasCliente::validar_modificar_campo_deuda($request);
        if ($validarDatos['estado'] == 'success') {
            $modificar = DeudasCliente::find($request->id);

            if (!is_null($modificar)) {
                switch ($request->campo) {

                case 'tipo_deuda_id':
                  $modificar->tipo_deuda_id = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Tipo de deuda actualizado.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'monto':
                  $modificar->monto = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Monto de la deuda actualizado.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'descripcion':
                  $modificar->descripcion = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Descripcion actualizada.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'fecha':
                  $modificar->fecha = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Fecha de tope actualizada.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;
                
                default:
                  return null;
                  break;
              }
            } else {
                return ['estado'=>'failed', 'mensaje'=>'El item que intentas modificar no existe.'];
            }
        } else {
            return $validarDatos;
        }
    }

    protected function pagar_deuda($request)
    {
        // dd($request->all());
        $deudaCliente = DeudasCliente::where([
                                             'id'=>$request->id,
                                             'activo'=>'S',
                                            ])
                                            ->get();

        if (count($deudaCliente) > 0) {

            if ($deudaCliente[0]->estado_deuda == 'PAGADO') {
                return ['estado'=>'failed_p', 'mensaje'=>'El pago ya fue realizado.'];
            }
    
            if (!$deudaCliente->isEmpty()) {
                $pagar = $this::find($request->id);
                $pagar->estado_deuda = 'PAGADO';
    
                if ($pagar->save()) {
                    {
                return ['estado'=>'success', 'mensaje'=>'Pago registrado con exito!.'];
                    }
                    return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al pagar la deuda.'];
                }
            }
        }
        return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al pagar la deuda.'];
    }
}
