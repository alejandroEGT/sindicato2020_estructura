<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $fillable = ['montoSolicitado', 'totalInteres', 'fecha', 'cuotas', 'idCliente', 'idUsuario', 'idTipo', 'activo'];
}
