<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route::get('home', 'Actividades\ActividadesController@index');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/', function()
{
    if(Auth::guest()){
        return View::make('/auth/login');
    } else {
        return View::make('/home');
    }
});

Route::get('auth/logout', 'Auth\AuthController@logout');

Route::get('/reporteArticulo', 'Reporte\Articulo@index');
Route::get('/reporteArticuloProveedor', 'Reporte\ArticuloProveedores@query');
Route::get('/dashboard', 'Reporte\Dashboard@reporte');
Route::get('/transferenciasarticulos', 'Reporte\TransferenciasArticulos@query');
Route::get('/reportesArticulosWeb', 'Reporte\ReportesArticulosWeb@getArticulosWeb');
Route::get('/altaArticulo', 'Articulo\Alta@nuevoArticulo');

Route::resource('articulos', 'Articulo\ArticulosController');
Route::resource('pedidos', 'Pedido\PedidosController');
Route::resource('cierreDiario', 'CierreDiario\CierreDiarioController');
Route::resource('facturaWeb', 'CierreDiario\FacturaWebController');
Route::resource('clientes', 'Cliente\ClientesController');
Route::resource('biclientearticulos', 'Api\Bi\ClientesArticulosController');
Route::resource('mapa', 'Api\Bi\MapaController');

/*Promociones*/
Route::resource('panelpromocion', 'Promociones\PanelPromocionController');
Route::get('promocionestado','Promociones\EstadoPanel@index');
Route::get('activarpromocion','Promociones\PromocionController@activar');
Route::get('finalizarpromocion','Promociones\PromocionController@finalizar');
Route::get('eliminarpromocion','Promociones\PromocionController@eliminar');
Route::resource('promocion','Promociones\PromocionController');



Route::group(['prefix' => 'api'],
    function () {
        Route::get('/listar', 'Api\FacturacionH@listar');
        Route::get('/borrargasto', 'Api\GastosController@delete');
        Route::get('/consultagastos', 'Api\ReporteController@query');
        Route::get('/consultagastosanual', 'Api\ReporteController@queryMenAnual');
        Route::get('/listaitems', 'Api\ListaItemsController@query');
        Route::get('/cajamin', 'Api\FacturacionH@cajaMin');
        Route::get('/login', 'Api\Login@authentic');
      //  Route::get('/crearusuario', 'Api\Login@crearLogin');
        Route::get('/reportes', 'Api\ReporteFacturacionH@reportes');
        Route::get('/reportesDashboardVentas', 'Api\ReportesDashboard@ventas');
        Route::get('/reportesDashboardVendedoras', 'Api\ReportesDashboard@vendedoras');
        Route::get('/reportesArticulos', 'Api\ReporteArticulos@masVendidos');
        Route::get('/proveedores', 'Api\ReporteProveedores@getProveedores');
        Route::get('/listaAllArticulos', 'Api\ListaAllArticulos@query');
        Route::get('/cotidolar', 'Api\CotiDolar@query');
        Route::get('/datosproveedor', 'Api\Proveedor@getInfo');
        Route::get('/listavendedoras', 'Api\ListaVendedoras@query');
        Route::get('/getnumpedido', 'Api\GeneraNroPedidos@generar');
        Route::post('/creopedido', 'Api\CreoPedido@inPedido');
        Route::get('/grafico', 'Api\DatosGrafico@obtengoArticulo');
        Route::get('/graficoVendedora', 'Api\DatosGrafico@obtengoArticuloVendedora');
        Route::get('/listaPedidosWeb', 'Api\ListaPedidosWeb@query');
        Route::get('/cierreCajaFacturaWeb', 'Api\CierreCajaFacturaWeb@query');
        Route::get('/modificoSiEsWeb', 'Api\ModificarArticuloWeb@modifico');
        Route::get('/sku', 'Api\Sku@query');
        Route::get('/refresh', 'Api\ArticuloProveedores@query');
        Route::get('/cancelarPedido', 'Api\cancelarPedido@cancelar');
        Route::get('/comentarios', 'Api\ListaComentariosWeb@query');
        Route::get('/agregarcomentarios', 'Api\AgregaComentariosWeb@agregar');

        Route::get('/proveedoresSelect', 'Api\ProveedoresSelect@query');
        Route::get('/provinciasSelect', 'Api\ProvinciasSelect@query');

        //  Route::post('/creopedido' , array('uses'  => 'Api\CreoPedido@inPedido'));

        /*Consultas BI*/
        Route::get('/biclientes', 'Api\Bi\Clientes@query');



    });
