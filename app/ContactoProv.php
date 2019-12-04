<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ContactoProv extends Model
{
    protected $table = "contactos_prov";

    protected function ingresarContactoProv($prov_id, $nombres, $apellidos, $fono, $correo)
    {
        $contacto = new ContactoProv;
        DB::beginTransaction();
        $contacto->nombres = $nombres;
        $contacto->apellidos = $apellidos;
        $contacto->correo = $correo;
        $contacto->telefono = $fono;
        $contacto->activo = 'S';
        $contacto->prov_id = $prov_id;
        if ($contacto->save()) {
            DB::commit();
            return true;
        } else {
            DB::rollBack();
            return false;
        }
    }
}
