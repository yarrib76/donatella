<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Ayuda\Precio;
use Donatella\Models\Articulos;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use TiendaNube\API;

class ABMTiendaNube extends Controller
{
    public function abmProductos()
    {
        $cantidadPorPaginas = 5;
        //Datos para la conexiòn
        $access_token = 'ce4bf7da2c19529c4f3134ec3cfa20b8a8faf90b';
        $store_id = '972788';

        $api = new API($store_id, $access_token, 'Test (yarrib76@gmail.com)');
        $cantidadConsultas = $this->obtengoCantConsultas($api,$cantidadPorPaginas);

        for ($i = 1; $i <= $cantidadConsultas; $i++){
            $articulosTiendaNube = $api->get("products?page=$i&per_page=$cantidadPorPaginas");
            $precioAydua = new Precio();
            foreach ($articulosTiendaNube->body as $articulo){
                foreach ($articulo->variants as $variant){
                    $articuloLocal = Articulos::where('Articulo',$variant->sku)->get();
                    if (!$articuloLocal->isEmpty()){
                        $response = $api->put("products/$variant->product_id/variants/$variant->id", [
                            'price' => $precioAydua->query($articuloLocal[0])[0]['PrecioVenta'],
                            'stock' => $this->verificoStock($articuloLocal[0])
                        ]);
                    }
                }
            }
        }
        return Response::json("ok");
    }
    public function verificoStock($articulo)
    {
        if ($articulo->Cantidad >= 4) {
            return "";
        }
        return 0;
    }

    private function obtengoCantConsultas($api,$cantidadPorPaginas)
    {
        $query = $api->get("products?page=1&per_page=1");
        $cantidadConsultas = (ceil(($query->headers['x-total-count'] / $cantidadPorPaginas)));
        return $cantidadConsultas;
    }
}
