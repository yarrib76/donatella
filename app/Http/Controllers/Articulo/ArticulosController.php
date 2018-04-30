<?php

namespace Donatella\Http\Controllers\Articulo;

use Donatella\Ayuda\CodigoBarras;
use Donatella\Http\Requests\CreateArticuloRequests;
use Donatella\Models\Articulos;
use Donatella\Models\Deposito;
use Donatella\Models\Dolar;
use Donatella\Models\Proveedores;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()){
            return View::make('/auth/login');
        } else {
            $articulos = Articulos::get();
            return view('articulos.reporte', compact('articulos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dolar = Dolar::get();
        $dolar = $dolar[0]->PrecioDolar;
        return view ('articulos.nuevo', compact('dolar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $codigoPais = '7798';
        $codigoBarra = new CodigoBarras();
        $articulo = $codigoPais . Input::get('Articulo');
        $codigoBit = $codigoBarra->crearDigitoCOntrol($articulo);
        $articulo = $articulo . $codigoBit;
        if (Input::get('Opciones') == 'opcion_dolares'){
            try {
                Articulos::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => Input::get('PrecioConvertido'),
                    'Moneda' => 'uSs',
                    'PrecioManual' => 0,
                    'Gastos' => 0,
                    'Ganancia' => 0,
                    'Proveedor' => Input::get('proveedor_name')
                ]);

                Deposito::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => Input::get('PrecioConvertido'),
                    'Moneda' => 'uSs',
                    'PrecioManual' => 0,
                    'Gastos' => 0,
                    'Ganancia' => 0,
                    'Proveedor' => Input::get('proveedor_name')
                ]);
                return redirect()->route('articulos.index');
                }catch (QueryException $ex) {
                switch ($ex->getCode()) {
                    case 23000:
                        return view('articulos.errores');
                        break;
                }
            }
        }

        if (Input::get('Opciones') == 'opcion_pesos'){
            try {
                Articulos::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => Input::get('PrecioConvertido'),
                    'Moneda' => 'ARG',
                    'PrecioManual' => 0,
                    'Gastos' => 0,
                    'Ganancia' => 0,
                    'Proveedor' => Input::get('proveedor_name')
                ]);

                Deposito::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => Input::get('PrecioConvertido'),
                    'Moneda' => 'ARG',
                    'PrecioManual' => 0,
                    'Gastos' => 0,
                    'Ganancia' => 0,
                    'Proveedor' => Input::get('proveedor_name')
                ]);
                return redirect()->route('articulos.index');
                }catch (QueryException $ex) {
                switch ($ex->getCode()) {
                    case 23000:
                        return view('articulos.errores');
                        break;
                }
            }
        }
        if (Input::get('Opciones') == 'opcion_manual'){
            try {
                Articulos::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => 0,
                    'Moneda' => '',
                    'PrecioManual' => Input::get('Manual'),
                    'Gastos' => Input::get('Gastos'),
                    'Ganancia' => Input::get('Ganancia'),
                    'Proveedor' => Input::get('proveedor_name')
                ]);

                Deposito::create([
                    'Articulo' => $articulo,
                    'Detalle' => Input::get('Detalle'),
                    'Cantidad' => Input::get('Cantidad'),
                    'PrecioOrigen' => Input::get('PrecioOrigen'),
                    'PrecioCOnvertido' => 0,
                    'Moneda' => '',
                    'PrecioManual' => Input::get('Manual'),
                    'Gastos' => Input::get('Gastos'),
                    'Ganancia' => Input::get('Ganancia'),
                    'Proveedor' => Input::get('proveedor_name')
                ]);
                return redirect()->route('articulos.index');
                }catch (QueryException $ex){
                    switch ($ex->getCode()){
                        case 23000: return view ('articulos.errores');
                        break;
                    }
                }


            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulos::where('Articulo', '=', $id)->get();
        $articulo = $articulo[0];
        return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $path = '/public/imagenes/articulos';
        $imageName1 = Input::get('image_name_1');
        if (Input::file('image_name_1')){
            $imageName1 = Input::file('image_name_1')->getClientOriginalName();
        }
        $this->muevoArchivosImages($imageName1,$path);
        Articulos::where('Articulo', '=', $id)->update([
            'ImageName' => $imageName1,
        ]);
        Deposito::where('Articulo', '=', $id)->update([
            'ImageName' => $imageName1,
        ]);
        return redirect()->route('articulos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function muevoArchivosImages($imageName1,$path)
    {
        if (Input::file('image_name_1')){
            //  $imageName1 = Input::get('cod_articulo') . "1" . Carbon::now()->toTimeString() . "." . Input::file('image_name_1')->getClientOriginalExtension();
            Input::file('image_name_1')->move(
                base_path() . $path, $imageName1);
        }
    }
}
