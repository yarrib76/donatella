<?php

namespace Donatella\Http\Controllers\Api\Bi;

use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bi.mapa',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function datos()
    {
        $datos = DB::select('select prov.nombre as Provincia, sum(facth.total) as Total
                            from samira.facturah as facth
                            inner join samira.clientes as cli ON cli.id_clientes = facth.id_clientes
                            inner join samira.provincias as prov ON prov.id = cli.id_provincia
                            where prov.nombre <> "Otro"
                            GROUP BY prov.nombre ORDER BY Total DESC;');
        $info=[];
        $datos = $this->conviertoProvincias($datos);
        foreach ($datos as $dato){
            $info[$dato['Provincia']] = ['value' => $dato['Total'], 'tooltip'=>['content' => $dato['Provincia'] . " $" . $dato['Total']]];
        }

       // $datos['tierradelfuego'] = ['value' => '2000', 'tooltip'=> ['content' => '5000' ]];
     //   $datos['santacruz'] = ['value' => '2268265', 'href:' => '#'];
    //    json = [{"tierradelfuego":{ "value": "2000", "href": "#","tooltip":{"content": "Facturacion 3000"}}}];

        return json_encode($info);
    }

    function conviertoProvincias ($datos){
        $i = 0;
        foreach ($datos as $dato){
            switch ($dato->Provincia){
                case "Buenos Aires": $datoConvertido[$i] = ["Provincia" => "bsas", "Total" => $dato->Total];
                    break;
                case "Catamarca": $datoConvertido[$i] = ["Provincia" => "catamarca", "Total" => $dato->Total];
                    break;
                case "Chaco": $datoConvertido[$i] = ["Provincia" => "chaco", "Total" => $dato->Total];
                    break;
                case "Chubut": $datoConvertido[$i] = ["Provincia" => "chubut", "Total" => $dato->Total];
                    break;
                case "Crdoba": $datoConvertido[$i] = ["Provincia" => "cordoba", "Total" => $dato->Total];
                    break;
                case "Corrientes": $datoConvertido[$i] = ["Provincia" => "corrientes", "Total" => $dato->Total];
                    break;
                case "Entre Ros": $datoConvertido[$i] = ["Provincia" => "entrerios", "Total" => $dato->Total];
                    break;
                case "Formosa": $datoConvertido[$i] = ["Provincia" => "formosa", "Total" => $dato->Total];
                    break;
                case "Jujuy": $datoConvertido[$i] = ["Provincia" => "jujuy", "Total" => $dato->Total];
                    break;
                case "La Pampa": $datoConvertido[$i] = ["Provincia" => "lapampa", "Total" => $dato->Total];
                    break;
                case "La Rioja": $datoConvertido[$i] = ["Provincia" => "larioja", "Total" => $dato->Total];
                    break;
                case "Mendoza": $datoConvertido[$i] = ["Provincia" => "mendoza", "Total" => $dato->Total];
                    break;
                case "Misiones": $datoConvertido[$i] = ["Provincia" => "misiones", "Total" => $dato->Total];
                    break;
                case "Neuqun": $datoConvertido[$i] = ["Provincia" => "neuquen", "Total" => $dato->Total];
                    break;
                case "Ro Negro": $datoConvertido[$i] = ["Provincia" => "rionegro", "Total" => $dato->Total];
                    break;
                case "Salta": $datoConvertido[$i] = ["Provincia" => "salta", "Total" => $dato->Total];
                    break;
                case "San Juan": $datoConvertido[$i] = ["Provincia" => "sanjuan", "Total" => $dato->Total];
                    break;
                case "San Luis": $datoConvertido[$i] = ["Provincia" => "sanluis", "Total" => $dato->Total];
                    break;
                case "Santa Cruz": $datoConvertido[$i] = ["Provincia" => "santacruz", "Total" => $dato->Total];
                    break;
                case "Santa Fe": $datoConvertido[$i] = ["Provincia" => "santafe", "Total" => $dato->Total];
                    break;
                case "Santiago del Estero": $datoConvertido[$i] = ["Provincia" => "santiago", "Total" => $dato->Total];
                    break;
                case "Tierra del Fuego": $datoConvertido[$i] = ["Provincia" => "tierradelfuego", "Total" => $dato->Total];
                    break;
                case "Tucumn": $datoConvertido[$i] = ["Provincia" => "tucuman", "Total" => $dato->Total];
                    break;
            }
            $i++;
        }
        return $datoConvertido;
    }
}
