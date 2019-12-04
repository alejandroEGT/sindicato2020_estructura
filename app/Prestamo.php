<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $fillable = ['montoSolicitado', 'totalInteres', 'fecha', 'idCliente', 'idUsuario', 'idTipo', 'activo'];
}
