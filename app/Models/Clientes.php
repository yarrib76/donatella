<?php

namespace Donatella\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = ['Nombre','Apellido','Direccion','Mail','Telefono','Cuit','Localidad','Provincia'];
}
