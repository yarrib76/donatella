<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Ayuda\Precio;
use Donatella\Models\Articulos;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use TiendaNube\API;
use TiendaNube\Auth;

class ABMTiendaNube extends Controller
{
    public function abmProductos()
    {
        //Para instalar la aplicación en mi tienda, ingresar a la parte administrador de la tienda,
        // 1. Abrir una nueva pestania y poner le url "https://www.tiendanube.com/apps/(app_id)/authorize",
        //2. Reemplazar (app_id) por el id de la aplicacion que se quiere instalar.
        //3. Luego tomar el Code y pegarlo en el codigo de abajo:
        //4. En la creación del objeto ingresar el id de la aplicación y el Clien Secret (esta en https://partners.tiendanube.com/apps/?ref=menu)

        /*
        $code = Pener el code del punto 3;
        $auth = new Auth(1056, 'gZck3RgyMZTA5YWGOXwrxqDG4pK10nKNJ1Ha2VaI62PwBFFC');
        $store_info = $auth->request_access_token($code);
        dd($store_info);*/

        //La cantidad de produtos por página
        $cantidadPorPaginas = 5;

        $store_id = 0;
        /*Verifica con que tienda tiene que sincronizar:
        Demo Nacha = 972788
        Samira SRL = 938857
        Donatella = 963000
        */
        if (Input::get('store_id') == '972788'){
            $access_token = 'ce4bf7da2c19529c4f3134ec3cfa20b8a8faf90b';
            $store_id = '972788';
            $appsName = 'SincroApps (yarrib76@gmail.com)';
        }
        if (Input::get('store_id') == '938857'){
            $access_token = '101d4ea2e9fe7648ad05112274a5922acf115d37';
            $store_id = '938857';
            $appsName = 'SincroApps (yarrib76@gmail.com)';
        }
        if (Input::get('store_id') == '963000'){
            $access_token = '00b27bb0c34a6cab2c1d4edc0792051b50b91f9e';
            $store_id = '963000';
            $appsName = 'SincoAppsDonatella (yarrib76@gmail.com)';
        }

        /*
        //Datos para la conexión Samira SRL
        $access_token = '101d4ea2e9fe7648ad05112274a5922acf115d37';
        $store_id = '938857'; */

        $api = new API($store_id, $access_token, $appsName);
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
        if ($articulo->Cantidad >= 6) {
            return "";
        }
        return 0;
    }

    /*Debido a que la API de tienda nube, no puede enviar mas de 200 productos por pagina, lo que hace esta funcion
    es tomar la cantidad de productos que hay en tienda nube y lo divide por la cantidad de productos por pagina. Con
    Esta información la urilizo en el FOR para solicitar todas las pagínas que tienen los artículos*/
    private function obtengoCantConsultas($api,$cantidadPorPaginas)
    {
        $query = $api->get("products?page=1&per_page=1");
        $cantidadConsultas = (ceil(($query->headers['x-total-count'] / $cantidadPorPaginas)));
        return $cantidadConsultas;
    }
}
