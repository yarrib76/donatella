<?php

namespace Donatella\Models;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = 'articulos';
    public $timestamps = false;
    protected $fillable = ['Articulo','Cantidad','Detalle','PrecioOrigen','PrecioCOnvertido','Moneda',
                            'PrecioManual','Gastos','Ganancia','Proveedor','ImageName'];
}
