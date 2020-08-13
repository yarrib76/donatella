<?php

namespace Donatella\Http\Controllers\Articulo;

use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;

class Barcode extends Controller
{
    public function crearCodigo()
    {
        $codigos[] = "";
        for ($i = 0; $i <= 1;$i++) {
            $codigos[$i] = ['codigo' =>'7798545006863','texto' =>'Pulsera Acero Bco  dijes NB686'] ;
        }

        return view('barcode.muestrabarcode', compact('codigos'));
    }
}
