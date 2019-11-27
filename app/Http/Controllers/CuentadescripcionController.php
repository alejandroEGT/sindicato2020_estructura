<?php

namespace App\Http\Controllers;

use App\Cuentadescripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CuentadescripcionController extends Controller
{
    public function crear(Request $r)
    {
    	try{
	    	$file = $this->guardarArchivo($r->archivo,'archivos_cuenta/');

			if($file['estado'] == "success"){
					$archivo = 'storage/'.$file['archivo'];
			}else{

					$archivo = '--';
					//return ['estado'=>'failed','mensaje'=>'el archivo no se subio correctamente'];
			}


	    	$c = new Cuentadescripcion;
	    	$c->cuenta_id = $r->cuenta_id;
	    	$c->fecha = $r->fecha;  
	    	$c->codigo = $r->codigo;
	    	$c->descripcion = $r->descripcion;
	    	$c->sub_cuenta_id = $r->sub_cuenta_id;
	    	$c->tipo_monto_id = $r->tipo_monto_id;
	    	$c->user_crea = Auth::user()->id;
	    	$c->archivo = $archivo;;
	    	$c->activo = 'S';

	    	($r->tipo_monto_id == 1) ? $c->monto_ingreso = $r->monto : $c->monto_egreso = $r->monto; 

	    	if ($c->save()) {
	    		return ['estado'=>'success', 'mensaje'=>'Item ingresado'];
	    	}else{

	    		Storage::delete('/'.$archivo);
	    		return ['estado'=>'failed', 'mensaje'=>'Error al ingresar'];
	    	}
	    
	    }catch(QueryException $e){
	    	Storage::delete('/'.$archivo);
			return[
				'estado'  => 'failed', 
				'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
				'error' => $e
			];
		}
		catch(\Exception $e){
			Storage::delete('/'.$archivo);
			return[
				'estado'  => 'failed', 
				'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
				'error' => $e
			];
		}
    }


    public function listar($mes, $anio, $cuenta)
    {
    	$list = DB::select("SELECT 
    							cd.id,
    							cd.fecha,
    							monto_ingreso,
								monto_egreso,
								cd.descripcion,
								archivo,
								codigo,
								sc.titulo titulo,
								cd.cuenta_id
    						from cuentas_descripcion cd
							inner join sub_cuenta sc on cd.sub_cuenta_id = sc.id
							where 
							    extract('month' from CAST(cd.fecha AS DATE)) = $mes and
							    extract('year' from CAST(cd.fecha AS DATE)) = $anio and
							    cd.cuenta_id = $cuenta and cd.activo = 'S'");
    	if (count($list) > 0) {
    		return ['estado'=>'success', 'lista' => $list];
    	}else{
    		return ['estado'=>'failed'];
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
	
	public function actualizar(Request $r)
	{
		
		$cd = Cuentadescripcion::find($r->id);


		switch ($r->nombre) {
		
			case 'fecha':
					$cd->fecha = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Fecha actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'archivo':
				# code...
			break;
			case 'descripcion':
				$cd->descripcion = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Descripcion actualizada'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'ingreso':
				$cd->monto_ingreso = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Monto ingreso actualizado'];
					}
					return ['estado'=>'failed', 'mensaje'=>'Error al actualizar'];
			break;
			case 'egreso':
				$cd->monto_egreso = $r->valor;
					if ($cd->save()) {
						return ['estado' => 'success', 'mensaje'=>'Monto egreso actualizado'];
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

	public function actualizar_archivo(Request $r){

		$cd = Cuentadescripcion::find($r->id);

		if ($cd) {
			$archivo = $this->guardarArchivo($r->valor,'archivos_cuenta/');

			if ($archivo['estado'] == 'success') {
				if ($cd->archivo == '--') { // si no hay archivo
					$cd->archivo = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}else{
					$ruta = substr($cd->archivo, 8);
					$borrar = Storage::delete($ruta);
					$cd->archivo = 'storage/'.$archivo['archivo'];
					if ($cd->save()) {
					
						return ['estado'=>'success','mensaje'=>'Archivo subido'];
					}
				}
			}
		}

	}

	public function eliminar_cuenta_detalle($id)
	{
		$cd = Cuentadescripcion::find($id);
		$cd->activo = 'N'; // borrado logico
		if($cd->save()){
			return [
				'estado'=>'success',
				'mensaje'=>'Item borrado con exito'
			];
		}
		return [
				'estado'=>'failed',
				'mensaje'=>'Error al borrar'
			];
	}
}
