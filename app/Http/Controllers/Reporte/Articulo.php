<?php

namespace Donatella\Http\Controllers\Reporte;

use Carbon\Carbon;
use Donatella\Models\Articulos;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Expr\Array_;

class Articulo extends Controller
{
    public function index()
    {
        $anio = Input::get('anio');
        if (empty($anio)){
            $anio = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->year;
        }
        $articulos = Articulos::get();

       return view ('Reporte.buscar', compact('articulos','anio'));
    }
}
