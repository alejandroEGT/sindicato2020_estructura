<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    protected $table = 'detalle_prestamo';
    protected $fillable = ['fecha', 'cuota', 'monto', 'estado', 'idPrestamo'];
}
