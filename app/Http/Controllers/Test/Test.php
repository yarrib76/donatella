<?php

namespace Donatella\Http\Controllers\Test;

use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;

class Test extends Controller
{
    public function Test()
    {
        $articulos = Articulos::orderBy("Proveedor")->get();
        $precioAydua = new Precio();
        $articulosPreoveedores[] = [];
        DB::select('truncate table samira.reportearticulo');
        foreach ($articulos as $articulo) {
            if (!is_null($articulo->Proveedor)) {
                $precio = $precioAydua->query($articulo);
                $proveedor = Proveedores::where('Nombre', $articulo->Proveedor)->get();
                ReporteArtiulos::create([
                    'Proveedor' => $proveedor[0]->Nombre,
                    'Pais' => $proveedor[0]->Pais,
                    'Articulo' => $articulo->Articulo,
                    'Detalle' => $articulo->Detalle,
                    'Costo' => $precio[0]['Gastos'],
                    'Ganancia' => $precio[0]['Ganancia'],
                    'Cantidad' => $articulo->Cantidad,
                    'PrecioOrigen' => $articulo->PrecioOrigen,
                    'Moneda' => $articulo->Moneda,
                    'PrecioConvertido' => $articulo->PrecioConvertido,
                    'PrecioManual' => $articulo->PrecioManual,
                    'PrecioArgDolar' => ($articulo->PrecioConvertido * $precio[0]['Gastos']),
                    'PrecioArgenPesos' => ($articulo->PrecioManual * $precio[0]['Gastos']),
                    'PrecioVenta' => $precio[0]['PrecioVenta'],
                    'CotizacionDolar' => Dolar::all()[0]->PrecioDolar
                ]);
            }
        }
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->toDateString();
        DB::table('statusreportes')->update(array('Fecha' => $fecha));
    }
}
