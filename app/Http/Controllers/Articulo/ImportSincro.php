<?php

namespace Donatella\Http\Controllers\Articulo;

use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ImportSincro extends Controller
{
    public function index()
    {

       // $url = ("http://dona.com/api/artisinc?Codigo=3869");
        $url = ("http://samirasrl.dyndns.org:8081/api/listaAllArticulos");
      //  $url = ("http://viam.dyndns.org/api/artisinc?Codigo=3869");
        ini_set('default_socket_timeout', 900);
        $jsons = file_get_contents(($url), true);
        return $jsons;
    }
}
