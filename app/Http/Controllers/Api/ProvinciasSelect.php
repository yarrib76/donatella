<?php

namespace Donatella\Http\Controllers\Api;

use Donatella\Models\Provincias;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ProvinciasSelect extends Controller
{
    public function query()
    {
        $provincias = Provincias::all();
        return Response::json($provincias);
    }
}
