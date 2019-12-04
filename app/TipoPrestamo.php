<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    protected $table = 'tipos_prestamos';
    protected $fillable = ['desripcion'];
}
