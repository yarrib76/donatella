<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\Articulos;
use Donatella\Models\Deposito;
use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class InArtSincro extends Controller
{
    public function nuevo()
    {
        $insertDatos = (Input::get('misDatos'));
        foreach ($insertDatos as $insertDato){
            $verificador = Articulos::where('Articulo', '=', $insertDato['Articulo'])->first();
            if ($verificador['Articulo'] === null){
                $this->crearArticulo($insertDato);
            } else {
                printf('El articulo ya existe');
            }
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
        return ;
    }
}
