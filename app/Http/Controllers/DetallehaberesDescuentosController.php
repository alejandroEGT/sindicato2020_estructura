<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Detalle_haberes_descuentos;

class DetallehaberesDescuentosController extends Controller
{
   
    public function insertar(Request $r)
    {
            $dhd = new Detalle_haberes_descuentos;
            $dhd->tipo_detalle = $r->detalle;
            $dhd->concepto = $r->concepto;
            $dhd->activo = 'S';

            if ($dhd->save()) {
                return [ 'estado'=>'success', 'mensaje'=>'Detalle ingresado'];
            }
            return [ 'estado'=>'failed', 'mensaje'=>'Error al ingresar'];
    }

    public function listar_detalle()
    {
        //liq_detalle_haberes_descuentos
            //$data = Detalle_haberes_descuentos::all();

            $data = DB::select("SELECT 
                                dhd.id,
                                tipo,
                                concepto
                                
                                AS tipo_detalle from liq_detalle_haberes_descuentos as dhd
                                inner join tipo_haberes_descuentos thd 
                                on thd.id = dhd.tipo_detalle where dhd.activo = 'S'

            ");

            if (count($data) > 0) {
                return response()->json($data);
            }
    }

    public function eliminar_detalle_hd($id)
    {
        $delete = Detalle_haberes_descuentos::find($id);
        $delete->activo = 'N';
        if ($delete->save()) {
            return [
                'estado'=>'success',
                'mensaje'=>'Item Eliminado'
            ];
        }
         return [
                'estado'=>'failed',
                'mensaje'=>'No se ha eliminado el item'
            ];
        
    }

    public function select_detalle_h_d()
    {
        return DB::table('tipo_haberes_descuentos')
        ->select(['id','tipo'])
        ->where('activo','S')->get();
    }
}
