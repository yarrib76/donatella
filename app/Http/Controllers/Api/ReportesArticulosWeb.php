<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Ayuda\Precio;
use Donatella\Models\Articulos;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportesArticulosWeb extends Controller
{
    public function getArticulosWeb()
    {
        $articulos = Articulos::where('Web', '=', 1)
            ->get();
        $query = $this->queryFinal($articulos);
        return $query;
    }

    public function queryFinal($articulos)
    {
        $precioAydua = new Precio();
        $query = [];
        $i = 0;
        foreach ($articulos as $articulo){
            $query [$i] = ['Articulo' => $articulo->Articulo,'Detalle' => $articulo->Detalle,'Precio' => $precioAydua->query($articulo)[0]['PrecioVenta']];
            $i++;
        }
        return $query;
    }
}
