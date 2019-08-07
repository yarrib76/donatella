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
        $insertDatos = (Input::get('misDatos'));
      /*  $articulo = Input::get('Articulo');
        $proveedor = Input::get('Proveedor');
        $detalle = Input::get('Detalle');
        $precioOrigen = Input::get('PrecioOrigen');
        $moneda = Input::get('Moneda'); */
        foreach ($insertDatos as $insertDato){
            $verificador = Articulos::where('Articulo', '=', $insertDato['Articulo'])->first();
            if ($verificador['Articulo'] === null){
                //$resultado = $this->crearArticulo($articulo,$detalle,$proveedor,$precioOrigen,$moneda);
                $this->crearArticulo($insertDato);
            }
            printf('El articulo ya existe');
        }

        return Response::json('Fin');
    }
    public function crearArticulo($insertDato)
    {
        Articulos::create([
            'Articulo' => $insertDato['Articulo'],
            'Detalle' => $insertDato['Detalle'],
            'Cantidad' => 0,
            'PrecioOrigen' => $insertDato['PrecioOrigen'],
            'PrecioCOnvertido' => 0,
            'Moneda' => $insertDato['Moneda'],
            'PrecioManual' => 0,
            'Gastos' => 0,
            'Ganancia' => 0,
            'Proveedor' => $insertDato['Proveedor']
        ]);

        Deposito::create([
            'Articulo' => $insertDato['Articulo'],
            'Detalle' => $insertDato['Detalle'],
            'Cantidad' => 0,
            'PrecioOrigen' => $insertDato['PrecioOrigen'],
            'PrecioCOnvertido' => 0,
            'Moneda' => $insertDato['Moneda'],
            'PrecioManual' => 0,
            'Gastos' => 0,
            'Ganancia' => 0,
            'Proveedor' => $insertDato['Proveedor']
        ]);
        return Response::json('Finalizado');
    }
}
