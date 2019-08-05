<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\Articulos;
use Donatella\Models\Deposito;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class InArtSincro extends Controller
{
    public function nuevo()
    {
        $articulo = Input::get('Articulo');
        $proveedor = Input::get('Proveedor');
        $detalle = Input::get('Detalle');
        $verificador = Articulos::where('Articulo', '=', $articulo)->first();
        if ($verificador['Articulo'] === null){
            $resultado = $this->crearArticulo($articulo,$detalle,$proveedor);
            return $resultado;
        }
        return Response::json('El articulo ya existe');
    }
    public function crearArticulo($articulo,$detalle,$proveedor)
    {
        Articulos::create([
            'Articulo' => $articulo,
            'Detalle' => $detalle,
            'Cantidad' => 0,
            'PrecioOrigen' => 0,
            'PrecioCOnvertido' => 0,
            'Moneda' => 'ARG',
            'PrecioManual' => 0,
            'Gastos' => 0,
            'Ganancia' => 0,
            'Proveedor' => $proveedor
        ]);

        Deposito::create([
            'Articulo' => $articulo,
            'Detalle' => $detalle,
            'Cantidad' => 0,
            'PrecioOrigen' => 0,
            'PrecioCOnvertido' => 0,
            'Moneda' => 'ARG',
            'PrecioManual' => 0,
            'Gastos' => 0,
            'Ganancia' => 0,
            'Proveedor' => $proveedor
        ]);
        return "Finalizado";
    }
}
