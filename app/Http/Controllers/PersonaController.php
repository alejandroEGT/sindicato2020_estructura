<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    public function validar_archivo($archivo, $campo_name, $formato)
    {
        if($archivo == "null" || $archivo == "undefined"){

            
            return "nofile";
        }else{
            return response()->json($_FILES[$campo_name]['type']);

            if($_FILES[$campo_name]['type']==$formato){
                return true;
                
            }

            if($_FILES[$campo_name]['type']!=$formato){
                return false;
            }
        }
    }
    public function crear_persona(Request $r)
    {
        
        try{
            $carga=null;
            $cony=null;
            $rut = strtoupper($r->rut);
            if(
                $r->familiar == 1 || //conyuge
                $r->familiar == 5 || //padre
                $r->familiar == 6 || //madre
                $r->familiar == 7 || //suegro
                $r->familiar == 8    //suegra
            ){
                
                $verify = DB::select("select * from persona 
                    where (rut = '".$rut."' or tipo_familiar =".$r->familiar.") and socio_id =".$r->socio_id."");
                // dd($verify);
                
                if (count($verify)>0) {
                    return [
                        'estado' => 'failed',
                        'mensaje' => 'La persona puede que ya exista 1'
                    ];     
                }
            }else{
                $verify = Persona::where('socio_id', $r->socio_id)
                        ->where('rut', $rut)
                       ->first();
                
                if ($verify) {
                    return [
                        'estado' => 'failed',
                        'mensaje' => 'La persona puede que ya exista 2'
                    ];     
                }
            }

            $validar_pdf1 = $this->validar_archivo($r->certificado_carga, 'certificado_carga', 'application/pdf');

            if ($validar_pdf1 == false) {
                return [
                    'estado' => 'failed',
                    'mensaje' => 'El archivo no es un PDF'
                ];  
            }

            $validar_pdf2 = $this->validar_archivo($r->certificado_matrimonio, 'certificado_matrimonio', 'application/pdf');

            if ($validar_pdf2 == false) {
                return [
                    'estado' => 'failed',
                    'mensaje' => 'El archivo no es un PDF'
                ];  
            }

                $carga = $this->guardarArchivo($r->certificado_carga,'certificado_carga/');
                $cony = $this->guardarArchivo($r->certificado_matrimonio,'certificado_matrimonio/');

                $p = new Persona;
                $p->socio_id = $r->socio_id;
                $p->tipo_familiar = $r->familiar;
                $p->nombres = $r->nombres;
                $p->apellidos = $r->apellidos;
                $p->rut = $rut;
                $p->fecha_nacimiento = $r->fecha_nacimiento;
                $p->direccion = $r->direccion;
                $p->celular = $r->celular;
                $p->certificado_conyuge = ($cony['estado'] == "success")? 'storage/'.$cony['archivo'] : '--';
                foreach (explode(',',$r->becana) as $key) {

                    switch ($key) {
                        case '3':/*carga*/  
                            $p->carga = $key;
                            $p->certificado_carga = ($carga['estado'] == "success")? 'storage/'.$carga['archivo'] : '--';
                             break;
                            //dd("alta kk");
                        case '2':/*beneficiario*/ 
                            $p->beneficiario = $key;
                            $p->orden_beneficiario = $r->orden_beneficio;
                        break;
                    
                    }
                }
                $p->activo = 'S';

                // dd($p);

                if ($p->save()) {

                    return [
                        'estado' => 'success',
                        'mensaje' => 'persona asociada a socio con exito'
                    ];
                }else{
                    if($cony['estado'] == "success"){
                        Storage::delete('/'.'storage/'.$cony['archivo']);
                    }
                    if($carga['estado'] == "success"){
                        Storage::delete('/'.'storage/'.$carga['archivo']);
                    }

                    return [
                        'estado' => 'failed',
                        'mensaje' => 'Error al guardar'
                    ];
                
                }
            
        }catch(QueryException $e){
	    	if($cony['estado'] == "success"){
                Storage::delete('/storage/'.$cony['archivo']);
            }
            if($carga['estado'] == "success"){
                Storage::delete('/storage/'.$carga['archivo']);
            }
			return[
				'estado'  => 'failed', 
				'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
				'error' => $e
			];
		}
		catch(\Exception $e){
			if($cony['estado'] == "success"){
                 Storage::delete('/storage/'.$cony['archivo']);
            }
            if($carga['estado'] == "success"){
                 Storage::delete('/storage/'.$carga['archivo']);
            }
			return[
				'estado'  => 'failed', 
				'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
				'error' => $e
			];
		}
    }

    public function listar_personas($socio_id)
    {
        $personas = DB::select("SELECT
                                 id,
                                socio_id,
                                tipo_familiar as tipo_familiar_id,
                                CASE
                                    WHEN tipo_familiar = 1 then 'Conyuge/pareja'
                                    when tipo_familiar = 2 then 'Hijo(a)'
                                    when tipo_familiar = 3 then 'Hijastro(a)'
                                    when tipo_familiar = 4 then 'Ahijado(a)'
                                    when tipo_familiar = 5 then 'Padre'
                                    when tipo_familiar = 6 then 'Madre'
                                    when tipo_familiar = 7 then 'Suegro'
                                    when tipo_familiar = 8 then 'Suegra'
                                    when tipo_familiar = 9 then 'Otros'
                                end as tipo_familiar,
                                nombres,
                                apellidos,
                                rut,
                                to_char(fecha_nacimiento,'dd/MM/yyyy') fecha_nacimiento,
                                fecha_nacimiento fecha_nacimiento_e,
                                direccion,
                                celular,
                                certificado_conyuge,
                                case 
                                  when beneficiario = '2' then 'SI'
                                  when beneficiario is null then 'NO'
                                 end as beneficiario,
                                orden_beneficiario,
                                case
                                  when carga = '3' then 'SI'
                                  when carga is null then 'NO'
                                 end as carga,
                                certificado_carga
                            from persona
                            where socio_id = $socio_id and activo='S'
                            order by tipo_familiar");
        
        if (count($personas)>0) {
            return[
                'estado' =>'success',
                'consulta' => $personas
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
    
    public function actualizar_archivo_con(Request $r){

		$cd = Persona::find($r->id);

		if ($cd) {

            $validar_pdf = $this->validar_archivo($r->valor, 'valor', 'application/pdf');

            if ($validar_pdf == false) {
                return [
                    'estado' => 'failed',
                    'mensaje' => 'El archivo no es un PDF'
                ];  
            }

			$archivo = $this->guardarArchivo($r->valor,'certificado_matrimonio/');

			if ($archivo['estado'] == 'success') {
				if ($cd->certificado_conyuge == '--') { // si no hay archivo
					$cd->certificado_conyuge = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}else{
					$ruta = substr($cd->certificado_conyuge, 8);
					$borrar = Storage::delete($ruta);
					$cd->certificado_conyuge = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
					
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}
			}
		}

    }
    
    public function actualizar_archivo_car(Request $r){

		$cd = Persona::find($r->id);

		if ($cd) {
            $validar_pdf = $this->validar_archivo($r->valor, 'valor', 'application/pdf');
            return response()->json($validar_pdf);
            if ($validar_pdf == false) {
                return [
                    'estado' => 'failed',
                    'mensaje' => 'El archivo no es un PDF'
                ];  
            }
			$archivo = $this->guardarArchivo($r->valor,'certificado_carga/');

			if ($archivo['estado'] == 'success') {
				if ($cd->certificado_carga == '') { // si no hay archivo
					$cd->certificado_carga = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}else{
					$ruta = substr($cd->certificado_carga, 8);
					$borrar = Storage::delete($ruta);
					$cd->certificado_carga = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
					
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}
			}
		}

    }

    public function actualizar(Request $r)
	{
		
		$cd = Persona::find($r->id);

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

			case 'fecha_nacimiento':
					$cd->fecha_nacimiento = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Fecha actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			
			case 'direccion':
				$cd->direccion = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Dirección actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'celular':
				$cd->celular = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Celular actualizado'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'orden_beneficio':
				$cd->orden_beneficiario = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Orden beneficiario actualizado'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'codigo':
				# code...
			break;
			
			default:
				# code...
				break;
		}
	}
    

}
