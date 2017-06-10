<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\Articulos;
use Donatella\Models\FacturacionHist;
use Donatella\Models\Facturas;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Psy\Util\Json;

class ReporteArticulos extends Controller
{
    public function masVendidos()
    {
      //  $query = $this->stock();
        $añoDesde = Input::get('anioDesde');
        $añoHasta = Input::get('anioHasta');
        $query = DB::select('SELECT  Articulo, FECHA,  Detalle, SUM(Cantidad) AS cantidad
                  FROM factura WHERE Fecha > "' . $añoDesde .'" and Fecha <= "' . $añoHasta .'"
                  GROUP BY Articulo HAVING cantidad > 20
                  ORDER BY cantidad DESC;');
        return Response::json($query);
    }

    public function stock()
    {
        $query = Facturas::where('Fecha', '>', '20170101')->get();

        return $query;
    }
    private function conviertoQueryEnArray($query)
    {
        $arr = [];
        foreach($query as $row)
        {
            $arr[] = (array) $row;
        }
        return $arr;
    }
}
