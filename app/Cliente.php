<?php

namespace App;

use Carbon\Carbon;
use App\TipoDeudaCliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Cliente extends Model
{
    protected $table = 'cliente';

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

    protected function registro_cliente($datos)
    {
        $limpiar = $this->limpiarRut($datos->rut);
        $verificar = $this->validarRut($limpiar);

        $verificarRut = Cliente::select([
                                        'rut',
                                    ])
                                        ->where('rut', $limpiar)
                                        ->get();
        if (count($verificarRut) > 0) {
            return ['estado'=>'failed', 'mensaje'=>'El rut ya existe en los registros.'];
        }

        if ($verificar == true) {
            $validarDatos = $this->validar_datos_cliente($datos);
            if ($validarDatos['estado'] == 'success') {
                $r = $this;
                $r->fecha_nacimiento = $datos->fecha_nacimiento;
                $r->rut = $limpiar;
                $r->nombres = $datos->nombres;
                $r->apellido_paterno = $datos->apellido_paterno;
                $r->apellido_materno = $datos->apellido_materno;
                $r->activo='S';

                if ($r->save()) {
                    return ['estado'=>'success', 'mensaje'=>'Cliente ingresado correctamente.'];
                } else {
                    return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error, verifique que los campos esten correctos'];
                }
            }
        } else {
            return ['estado'=>'failed', 'mensaje'=>'El rut ingresado no es valido.'];
        }

        return $validarDatos;
    }
    
    protected function traer_cliente()
    {
        $listar = Cliente::select([
                                    'id',
                                    'fecha_nacimiento',
                                    'rut',
                                    'nombres',
                                    'apellido_paterno',
                                    'apellido_materno',
                                ])
                                    ->where('activo', 'S')
                                    ->orderby('id', 'asc')
                                    ->get();
        if (count($listar) > 0) {
            foreach ($listar as $key) {
                $key->fecha_nacimiento = Carbon::parse($key->fecha_nacimiento)->format('d/m/Y');
                $key->nombres = ucwords($key->nombres);
                $key->apellido_paterno = ucfirst($key->apellido_paterno);
                $key->apellido_materno = ucfirst($key->apellido_materno);
            }
        }

        if (!$listar->isEmpty()) {
            return ['estado'=>'success' , $listar];
        } else {
            return ['estado'=>'failed', 'mensaje'=>'Aun no existen datos para mostrar.'];
        }
    }

    protected function validar_modificar_campo_cliente($request)
    {
        switch ($request->campo) {
        case 'fecha_nacimiento':
          $validator = Validator::make(
              $request->all(),
              [
              'input' => 'required'
            ],
              [
              'input.required' => 'Debe ingresar una fecha de nacimiento.'
            ]
          );
          break;
        
          case 'rut':
                $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|unique:cliente,rut|min:2|max:20'
            ],
                [
              'input.required' => 'Debe ingresar una fecha de nacimiento.',
              'input.unique' => 'El rut ya existe en los registros',
              'input.min' => 'El minimo de caracteres es de 2',
              'input.max' => 'El maximo de caracteres es de 20'
            ]
            );
            break;

          case 'nombres':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:3|max:50'
            ],
                [
              'input.required' => 'Debe ingresar un nombre como minimo.',
              'input.min' => 'El minimo de caracteres es de 3',
              'input.max' => 'El maximo de caracteres es de 50'
            ]
            );
            break;

          case 'apellido_paterno':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:3|max:50'
            ],
                [
              'input.required' => 'Debe ingresar un apellido paterno.',
              'input.min' => 'El minimo de caracteres es de 3',
              'input.max' => 'El maximo de caracteres es de 50'
            ]
            );
            break;

          case 'apellido_materno':
            $validator = Validator::make(
                $request->all(),
                [
              'input' => 'required|min:3|max:50'
            ],
                [
              'input.required' => 'Debe ingresar un apellido materno.',
              'input.min' => 'El minimo de caracteres es de 3',
              'input.max' => 'El maximo de caracteres es de 50'
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

    protected function modificar_campo_cliente($request)
    {
        $validarDatos = $this->validar_modificar_campo_cliente($request);
       
        
        if ($validarDatos['estado'] == 'success') {
            $modificar = $this::find($request->id);

            if (!is_null($modificar)) {
                switch ($request->campo) {

                case 'fecha_nacimiento':
                  $modificar->fecha_nacimiento = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Fecha de nacimiento actualizada.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'rut':
                  $limpiar = $this->limpiarRut($request->input);
                  $verificar = $this->validarRut($limpiar);

                  $verificarRut = Cliente::select([
                                                  'rut',
                                              ])
                                                  ->where('rut', $limpiar)
                                                  ->get();
                  if (count($verificarRut) > 0) {
                      return ['estado'=>'failed', 'mensaje'=>'El rut ya existe en los registros.'];
                  }
                      if ($verificar == true) {
                          $modificar->rut = $limpiar;

                          if ($modificar->save()) {
                              return ['estado'=>'success', 'mensaje'=>'Rut del cliente actualizado.'];
                          } else {
                              return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                          }
                      }
                      return ['estado'=>'failed', 'mensaje'=>'El rut ingresado no es valido.'];
                    
                   
                  break;

                case 'nombres':
                  $modificar->nombres = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Nombre actualizado.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'apellido_paterno':
                  $modificar->apellido_paterno = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Apellido paterno actualizado.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'apellido_materno':
                  $modificar->apellido_materno = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Apellido materno actualizado.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
                  break;

                case 'activo':
                  $modificar->activo = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'cliente eliminado con exito.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al eliminar el cliente.'];
                  }
                  break;
                
                default:
                  return null;
                  break;
              }
            }
            return ['estado'=>'failed', 'mensaje'=>'El item que intentas modificar no existe.'];
        }
        return $validarDatos; 
    }

    protected function eliminar_cliente($request)
    {
        $deudaCliente = DeudasCliente::where([
                                             'cliente_id'=>$request->id,
                                             'activo'=>'S'
                                            ])
                                            ->get();
        
        if ($deudaCliente->isEmpty()) {
            $eliminar = $this::find($request->id);
            $eliminar->activo = 'N';

            if ($eliminar->save()) {
                {
            return ['estado'=>'success', 'mensaje'=>'Cliente Eliminado con exito!.'];
        }
                return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al eliminar el cliente.'];
            }
        } else {
            return ['estado'=>'failed', 'mensaje'=>'No es posible eliminar a este cliente ya que tiene deudas registradas.'];
        }
    }

    protected function prestamo_cliente($request)
    {
        
    }

    protected function traer_clientes_deudas()
    {
        $listar = $this::select([
                              'id',
                              DB::raw("INITCAP(concat(nombres ,' ', 
                                                      apellido_paterno ,' ', 
                                                      apellido_materno)) 
                                                      as cliente_deuda")
                              ])
                              ->where('activo', 'S')
                              ->get();
                              
        if (count($listar) > 0) {
            return $listar;
        } else {
            return "no hay clientes para mostrar";
        }
    }

    protected function traer_tipo_deuda()
    {
        $listar = TipoDeudaCliente::select([
                            'id',
                            'tipo'
                            ])
                            ->where('activo', 'S')
                            ->get();
      
        if (count($listar) > 0) {
            return $listar;
        } else {
            return ("no hay datos para mostrar");
        }
    }
}
