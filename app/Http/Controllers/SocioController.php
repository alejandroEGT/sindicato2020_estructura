<?php

namespace App\Http\Controllers;

use App\User;
use App\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function insertar_socio(Request $r)
    {
        return Socio::insertar($r);
    }

    public function listar_socios($b='')
    {
        return Socio::listar($b);
    }
    public function listar_socio($b='')
    {
        return Socio::listar_s($b);
    }

    public function entorno_familiar()
    {
        return [
            ['id'=> '1' ,'nombre'=> 'Conyuge / Pareja'],
            ['id'=> '2' ,'nombre'=> 'Hijo(a)'],
            ['id'=> '3' ,'nombre'=> 'Hijastro'],
            ['id'=> '4' ,'nombre'=> 'Ahijado'],
            ['id'=> '5' ,'nombre'=> 'Padre'],
            ['id'=> '6' ,'nombre'=> 'Madre'],
            ['id'=> '7' ,'nombre'=> 'Suegro'],
            ['id'=> '8' ,'nombre'=> 'Suegra'],
            ['id'=> '9' ,'nombre'=> 'Otros']

        ];
    }

    public function listar_socio_id($id)
    {
       
        $socio = Socio::find($id);
        if ($socio) {
            return [
                'estado' => 'success',
                'socio' => $socio
            ];
        }
        return [
                'estado' => 'failed',
                'socio' => null
            ];
    }

     public function actualizar(Request $r)
	{
		
		$cd = Socio::find($r->id);

        if ($r->valor == '') {
            return [
                'estado'=>'failed',
                'mensaje'=>'LLene el campo'
            ];
        }

		switch ($r->nombre) {
            
            case 'nombres':
					$cd->nombres = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Nombre actualizado'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
            break;
            
            case 'apellidos':
					$cd->apellidos = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Apellidos actualizados'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
            break;
            
            case 'rut':
					$cd->rut = strtoupper($r->valor);
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Rut actualizados'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
            break;
            
            case 'email':
                    $u = User::find($r->id);
					$u->email = $r->valor;
					if ($u->save()) {
						return ['estado' => 'success', 'mensaje'=>'Email actualizado'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;

			case 'fecha_nacimiento':
					$cd->fecha_nacimiento = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Fecha nacimiento actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			
			case 'fecha_ingreso':
				$cd->fecha_ingreso = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Fecha ingreso actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'fecha_egreso':
				$cd->fecha_egreso = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Fecha egreso actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			
			
			default:
				# code...
				break;
		}
    }

    public function validar_archivo($archivo, $campo_name, $formato)
    {
        if($archivo == "null" || $archivo == "undefined"){
            return "nofile";
        }else{
            if($_FILES[$campo_name]['type']==$formato){
                return true;
                
            }

            if($_FILES[$campo_name]['type']!=$formato){
                return false;
            }
        }
    }
    
    public function entregar_beneficio(Request $r)
    {

       $validar_pdf=$this->validar_archivo($r->archivo1,'archivo1', 'application/pdf');

       if ($validar_pdf == false) {
           return [
               'estado' => 'failed',
               'mensaje' => 'El archivo no es un PDF'
           ];  
       }

       
    }
}
