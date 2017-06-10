<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\Articulos;
use Donatella\Models\Facturas;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ReporteArticulos extends Controller
{
    public function masVendidos()
    {
        $añoDesde = Input::get('anioDesde');
        $añoHasta = Input::get('anioHasta');
        $articulosVendidos = Facturas::groupBy('Articulo')
            ->selectRaw('Articulo, Fecha, Detalle, sum(Cantidad) as Cantidad')
            ->where ('Fecha', '>=', $añoDesde)
            ->where ('Fecha', '<=', $añoHasta)
            ->orderBy('Cantidad', 'DESC')
            ->get();
        $stockArticulos = $this->stock();
        $query = $this->reporteFinal($stockArticulos,$articulosVendidos);

        return Response::json($query);
    }

    public function stock()
    {
       // $query = Facturas::where('Fecha', '>', '2015-01-01')->get();
        $query = Articulos::groupBy('Articulo')
            ->selectRaw('sum(Cantidad) as Cantidad, Articulo')
            ->orderBy('Cantidad', 'DESC')
            ->get();
        return $query;
    }

    private function reporteFinal($stockArticulos, $articulosVendidos)
    {
        $i = 0;
        foreach ($articulosVendidos as $articulosVendido){
            $articulo = $stockArticulos->where('Articulo', $articulosVendido->Articulo)->first();
                if (!empty($articulo)) {
                   $datos[$i] = ['Articulo' => $articulosVendido->Articulo,
                        'Detalle' => $articulosVendido->Detalle,
                        'TotalVendido' => $articulosVendido->Cantidad,
                        'TotalStock' => $articulo->Cantidad];
                }
            $i ++;
        }
        return $datos;
    }

//3.291.520
//2.324.775
    /*En desuso ya que no trae todos los campos necesarios
      $query = DB::select('SELECT  Articulo, FECHA,  Detalle, SUM(Cantidad) AS cantidad
                    FROM factura WHERE Fecha > "' . $añoDesde .'" and Fecha <= "' . $añoHasta .'"
                    GROUP BY Articulo HAVING cantidad > 20
                    ORDER BY cantidad DESC;');*/
}
