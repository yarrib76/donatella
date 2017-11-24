<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\PedidosTemp;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CreoPedido extends Controller
{
    public function inPedido()
    {

        $datos =  Input::all();
      //  return $datos[0]['Vendedora'];
        foreach ($datos as $dato){
            PedidosTemp::create([
                'nroPedido' => $dato['nroPedido'],
                'Articulo' => $dato['Articulo'],
                'Detalle' => $dato['Detalle'],
                'Cantidad' => $dato['Cantidad'],
                'PrecioArgen' => $dato['PrecioArgen'],
                'PrecioUnitario' => $dato['PrecioUnitario'],
                'PrecioVenta' => $dato['PrecioVenta'],
                'Ganancia' => $dato ['Ganancia'],
                'Cajera' => 'None',
                'Vendedora' => $dato['Vendedora'],
                'Estado' => '0'
            ]);
    }
    }
}
