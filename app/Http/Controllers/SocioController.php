<?php

namespace App\Http\Controllers;

use App\User;
use App\Socio;
use App\Beneficiosocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

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
        
    
        if ($r->tipo != "GASTO MEDICO" && $r->persona == '') {
            return ['estado'=>'failed', 'mensaje'=> 'No ha seleccionado una persona'];
        }

       $validar_pdf=$this->validar_archivo($r->archivo1,'archivo1', 'application/pdf');
        
       if ($validar_pdf === "nofile") {

        
           return [
               'estado' => 'failed',
               'mensaje' => 'No existe un archivo como documento comprobante'
           ];  
       }


       if ($validar_pdf == false) {
           return [
               'estado' => 'failed',
               'mensaje' => 'El archivo no es un PDF'
           ];  
       }

       $validar_pdf2=$this->validar_archivo($r->archivo2,'archivo1', 'application/pdf');

       if ($validar_pdf2 == false) {
           return [
               'estado' => 'failed',
               'mensaje' => 'El archivo no es un PDF'
           ];  
       }

       $verify = Beneficiosocio::where([
           'socio_id' => $r->socio,
           'persona_id' => $r->persona,
           'tipo' => $r->tipo,
           'activo' => 'S'
        ])->first();
      

       if (!$verify) {
           
            $file1 = $this->guardarArchivo($r->archivo1,'archivos_beneficio/');

			if($file1['estado'] == "success"){
					$archivo1 = 'storage/'.$file1['archivo'];
			}else{
					$archivo1 = '--';
            }
            
            $file2 = $this->guardarArchivo($r->archivo2,'archivos_beneficio/');

			if($file2['estado'] == "success"){
					$archivo2 = 'storage/'.$file1['archivo'];
			}else{
					$archivo2 = '--';
            }

            try{

                $b = new Beneficiosocio;
                $b->socio_id = $r->socio;
                $b->persona_id = ($r->tipo != "GASTO MEDICO")?$r->persona : null;
                $b->tipo = $r->tipo;
                $b->archivo_1 = $archivo1;
                $b->archivo_2 = $archivo2;
                $b->fecha = $r->fecha;
                $b->monto = $r->monto;
                $b->numero_comprobante = $r->numero_comprobante;   
                $b->detalle = $r->detalle;
                $b->activo = 'S';
                
                
                if ($b->save()) {
                    return [
                        'estado' => 'success',
                        'mensaje' => 'Beneficio entregado'
                    ];
                }
                $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                return [
                        'estado' => 'failed',
                        'mensaje' => 'No se ha podido entregar el beneficio'
                ];
            
             }catch(QueryException $e){
                 $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                    DB::rollBack();
                    return[
                        'estado'  => 'failed', 
                        'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                        'error' => $e
                    ];
            }
            catch(\Exception $e){
                $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                    DB::rollBack();
                    return[
                        'estado'  => 'failed', 
                        'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                        'error' => $e
                    ];
            }


       }else{
            $file1 = $this->guardarArchivo($r->archivo1,'archivos_beneficio/');

			if($file1['estado'] == "success"){
					$archivo1 = 'storage/'.$file1['archivo'];
			}else{
					$archivo1 = '--';
            }
            
            $file2 = $this->guardarArchivo($r->archivo2,'archivos_beneficio/');

			if($file2['estado'] == "success"){
					$archivo2 = 'storage/'.$file1['archivo'];
			}else{
					$archivo2 = '--';
            }

           if ($r->tipo == "GASTO MEDICO") {
            try{

                $b = new Beneficiosocio;
                $b->socio_id = $r->socio;
                $b->persona_id = ($r->tipo != "GASTO MEDICO")?$r->persona : null;
                $b->tipo = $r->tipo;
                $b->archivo_1 = $archivo1;
                $b->archivo_2 = $archivo2;
                $b->fecha = $r->fecha;
                $b->monto = $r->monto;
                $b->numero_comprobante = $r->numero_comprobante;   
                $b->detalle = $r->detalle;
                $b->activo = 'S';
                
                
                if ($b->save()) {
                    return [
                        'estado' => 'success',
                        'mensaje' => 'Beneficio entregado'
                    ];
                }
                $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                return [
                        'estado' => 'failed',
                        'mensaje' => 'No se ha podido entregar el beneficio'
                ];
            
             }catch(QueryException $e){
                 $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                    DB::rollBack();
                    return[
                        'estado'  => 'failed', 
                        'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                        'error' => $e
                    ];
            }
            catch(\Exception $e){
                $ruta1 = substr($archivo1, 8);
                $ruta2 = substr($archivo2, 8);
                $borrar = Storage::delete($ruta1);
                $borrar2 = Storage::delete($ruta2);
                    DB::rollBack();
                    return[
                        'estado'  => 'failed', 
                        'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                        'error' => $e
                    ];
            }
           }
            return[
                        'estado'  => 'failed', 
                        'mensaje' => 'Beneficio YA entregado para esta persona',
                       
                    ];
       }

       
    }

    public function listar_beneficios_dados($socio)
    {
        $consulta = DB::select("SELECT
                                    b.id beneficio_socio_id,
                                    p.id persona_id,
                                    b.socio_id,
                                    b.archivo_1,
                                    b.archivo_2,
                                    b.detalle,
                                    b.fecha,
                                    b.monto,
                                    b.numero_comprobante,
                                    b.tipo,
                                    CONCAT(p.nombres,' ',p.apellidos) persona
                                FROM beneficio_socio b
                                LEFT JOIN persona p on p.id = b.persona_id
                                where b.socio_id = $socio");
        
        if (count($consulta)>0) {
            return [
                'estado'=>'success',
                'consulta'=>$consulta
            ];
        }
    }

    protected function guardarArchivo($archivo, $ruta)
            {
                try{
                    $filenameext = $archivo->getClientOriginalName();
                    $filename = pathinfo($filenameext, PATHINFO_FILENAME);
                    $extension = $archivo->getClientOriginalExtension();
                    $nombreArchivo = $filename . '_' . time() . '.' . $extension;
                    $rutaDB = $ruta . $nombreArchivo;

                    $guardar = Storage::put($ruta . $nombreArchivo, (string) file_get_contents($archivo), 'public');

                    if ($guardar) {
                        return ['estado' =>  'success', 'archivo' => $rutaDB];
                    } else {
                        return ['estado' =>  'failed', 'mensaje' => 'error al guardar el archivo.'];
                    }
                }catch (\Throwable $t) {
                        return ['estado' =>  'failed', 'mensaje' => 'error al guardar el archivo, posiblemente este dañado o no exista.'];
                }
            }
}
