<?php

namespace App\Http\Controllers;

use App\Liquidacion;
use App\LiquidacionDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionesController extends Controller
{
    public function select_nombre()
    {
        $select = DB::select("SELECT
                                 id, concat(nombres,' ',apellido_paterno,' ',apellido_materno) nombre 
                            from empleados");

        if(count($select)>0){
            return $select;
        }
    }
    public function traer_datos_persona($id)
    {
        $datos = DB::select("SELECT id, concat(nombres,' ',apellido_paterno,' ',apellido_materno) nombre, rut,
                             fecha_contrato, puesto_trabajo
                                FROM empleados where id = $id and activo = 'S'
                            ");
        if (count($datos) > 0) {
            return response()->json($datos[0]);
        }
    }

    public function afp_y_isapre()
    {
        $afp = DB::table('afp')->where('activo','S')->get();
        $isapre = DB::table('isapre')->where('activo','S')->get();

        return [
            'afp'=>$afp,
            'isapre'=>$isapre
        ];
    }

    public function listar_hh_dd()
    {
        return DB::select("SELECT 
                                 dhd.id,
                                tipo,
                                concepto AS tipo_detalle, 
                                monto,
                                case 
                                    when monto is null then 'N' 
                                    else 'S'
                                 end as verify
                                from liq_detalle_haberes_descuentos as dhd
                                inner join tipo_haberes_descuentos thd 
                                on thd.id = dhd.tipo_detalle 
                                left join liq_detalle_haberes_descuentos_empleado le on le.liq_detalle_haberes_descuentos_id = dhd.id and empleado_id = 0 and liquidacion_id = 0
                                
                                
                                
                                where dhd.activo = 'S'");
    }

    public function guardar_liquidacion_datos_basicos(Request $r)
    {

        $l = new Liquidacion;
        $l->fecha = $r->fecha_emicion;
        $l->empleado_id = $r->empleado_id;
        $l->empresa = 'NeoFox'; // cambiar despues este campo;
        $l->rut = '770652995';
        $l->puesto_trabajo = $r->puesto_trabajo;
        $l->sueldo_base_mensual = $r->sueldo_base_mensual;
        $l->dias_trabajados = $r->dias_trabajados;
        $l->horas_extras = $r->horas_extras;
        $l->valor_horas_extras = $r->valor_horas_extras;
        $l->valor_horas_ordinarias = $r->valor_hora_ordinaria;
        $l->afp_id = $r->afp;
        $l->isapre_id = $r->isapre;
        $l->activo='S';

        if ($l->save()) {
            return [
                'estado'=>'success',
                'mensaje'=>'Liquidacion con datos básicos creados, a continuacion se sigue con los haberes y descuentos, la identidad de la liquidacion es: '.$l->id,
                'liquidacion_id' => $l->id
            ];
        }

    }

    public function guardar_liquidacion_detalle(Request $r)
    {
        $empleado = Liquidacion::where([
                        'activo' => 'S',
                        'id' => $r->liquidacion_id
                    ])->first();
       
        $insert = LiquidacionDetalle::guardar($r, $empleado->empleado_id);
        
        if ($insert == true) {  
            $listar_h_d = DB::select("SELECT 
                                 dhd.id,
                                tipo,
                                concepto AS tipo_detalle, 
                                monto,
                                case 
                                    when monto is null then 'N' 
                                    else 'S'
                                 end as verify

                                from liq_detalle_haberes_descuentos as dhd
                                inner join tipo_haberes_descuentos thd 
                                on thd.id = dhd.tipo_detalle 
                                left join liq_detalle_haberes_descuentos_empleado le 
                                on le.liq_detalle_haberes_descuentos_id = dhd.id 
                                and empleado_id = $empleado->empleado_id and liquidacion_id = $r->liquidacion_id

                                where dhd.activo = 'S'");

            return [
                'estado' => 'success',
                'mensaje' => 'Item ingresado',
                'listar' => $listar_h_d
            ];
        }else{
            return[
                'esatdo'=>'failed',
                'mensaje'=>'error al ingresar'
            ];
        }

        


    }

    public function listar_liquidaciones()
    {
//         id
// fecha
// empresa
        $listar = DB::select("SELECT 
    
                                l.id,
                                to_char(l.fecha,'dd/mm/YYYY') fecha,
                                l.empresa,
                                concat(nombres,' ',apellido_paterno,' ',apellido_materno) empleado

                            from liquidacion l
                            inner join empleados e on e.id = l.empleado_id where e.activo = 'S'");

        if (count($listar)>0) {
            return [
                'estado'=>'success',
                'tabla'=>$listar
            ];
        }
    }

    public function listar_liquidaciones_edit()
    {   
        $query=[];
         $listar = DB::select("SELECT x.id, concat(x.fecha,'-',x.empleado,'-',x.id) texto, 'insert_drive_file' as icon
                        from ( SELECT 
                            
                            l.id,
                            to_char(l.fecha,'dd/mm/YYYY') fecha,
                            l.empresa,
                            concat(nombres,' ',apellido_paterno,' ',apellido_materno) empleado

                            from liquidacion l
                            inner join empleados e on e.id = l.empleado_id where e.activo = 'S') x");

        if (count($listar)>0) {
            $i=0;
            foreach ($listar as $key) {
                $query[$i]['label'] = $key->texto;
                $query[$i]['icon'] = $key->icon;
                $i++;
            }


            return [
                'estado'=>'success',
                'tabla'=>$query
            ];
        }
    }
    public function datos_liqu_edit($liq_id)
    {
        $listar = DB::select("SELECT 
                    l.id,
                    l.empresa,
                    concat(nombres,' ',apellido_paterno,' ',apellido_materno) empleado,
                    e.rut,
                    fecha_contrato,
                    l.puesto_trabajo,
                    l.dias_trabajados,
                    l.fecha as fecha_emicion,
                    l.sueldo_base_mensual,
                    l.horas_extras,
                    l.valor_horas_extras,
                    l.valor_horas_ordinarias,
                    l.afp_id,
                    a.nombre afp,
                    l.isapre_id,
                    i.nombre isapre

                    from liquidacion l
                    inner join afp  a on a.id = l.afp_id
                    inner join isapre i on i.id = l.isapre_id 
                    inner join empleados e on e.id = l.empleado_id where l.activo = 'S'
                    
                    and l.id = $liq_id");
        
        if (count($listar)>0) {
            return response()->json($listar[0]);
        }
    }

    public function tabla_haberes_descuentos_edit($liquidacion_id)
    {
         $listar_h_d = DB::select("SELECT 
                                 dhd.id,
                                tipo,
                                concepto AS tipo_detalle, 
                                monto,
                                case 
                                    when monto is null then 'N' 
                                    else 'S'
                                 end as verify

                                from liq_detalle_haberes_descuentos as dhd
                                inner join tipo_haberes_descuentos thd 
                                on thd.id = dhd.tipo_detalle 
                                left join liq_detalle_haberes_descuentos_empleado le 
                                on le.liq_detalle_haberes_descuentos_id = dhd.id 
                                and liquidacion_id = $liquidacion_id

                                where dhd.activo = 'S'");
                                
            if (count($listar_h_d)>0) {
                return $listar_h_d;
            }
            
    }
}
