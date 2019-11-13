<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected function registro_cliente($datos)
    {
        $r = $this;
        $r->fecha_nacimiento = $datos->fecha_nacimiento;
        $r->rut = $datos->rut;
        $r->nombres=$datos->nombres;
        $r->apellido_paterno=$datos->apellido_paterno;
        $r->apellido_materno=$datos->apellido_materno;
        $r->activo='S';

        if ($r->save()) {
            return true;
        } else {
            return false;
        }
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
                                    ->orderby('id', 'asc')
                                    ->get();
        if (count($listar) > 0) {
          foreach ($listar as $key) {
            $key->fecha_nacimiento =  Carbon::parse($key->fecha_nacimiento)->format('d-m-Y');
            $key->nombres = ucwords($key->nombres);
            $key->apellido_paterno = ucfirst($key->apellido_paterno);
            $key->apellido_materno = ucfirst($key->apellido_materno);
          }
            return
        [
          'respuesta' => true,
          'listar' => $listar,
        ];
        } else {
            return
        [
         'respuesta' => false,
        ];
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
                  $modificar->rut = $request->input;

                  if ($modificar->save()) {
                      return ['estado'=>'success', 'mensaje'=>'Fecha de nacimiento actualizada.'];
                  } else {
                      return ['estado'=>'failed', 'mensaje'=>'A ocurrido un error al igreso de datos.'];
                  }
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
}
