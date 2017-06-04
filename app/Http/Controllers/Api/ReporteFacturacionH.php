<?php

namespace Donatella\Http\Controllers\Api;

use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ReporteFacturacionH extends Controller
{

    public function reportes()
    {
        $resulatdo = $this->queryMenAnual();
        return $resulatdo;
    }
    public function queryMenAnual()
    {
      $año = Input::get('anio');
        $año = "2016";
      //  $facturacion = RegistroGastos::selectRaw('DATE_FORMAT(fecha, "%m-%Y") AS Month,sum(importe) as sum, fecha')
      //      ->groupBy('month')
      //      ->get();
        $query = DB::select('SELECT DATE_FORMAT(fecha, "%m") AS Month, ROUND(SUM(CASE WHEN Descuento <> "null" THEN Descuento ELSE total END),2) as total
                            from samira.facturah where fecha >= "' . $año .'/01/01" and Fecha <= "' . $año .'/12/31" group by Month');
        $reporteMeses = $this->convertirNumeroMes($query);

        return $reporteMeses;
    }

    public function convertirNumeroMes($querys)
    {
        $meses = "";
        foreach ($querys as $query)
        {
            switch ($query->Month)
            {
                Case 1:
                    $meses[1]= ['Mes' => "Enero", 'Total' => $query->total];
                    break;
                Case 2:
                    $meses[2]= ['Mes' => "Febrero", 'Total' => $query->total];
                    break;
                Case 3:
                    $meses[3]= ['Mes' => "Marzo", 'Total' => $query->total];
                    break;
                Case 4:
                    $meses[4]= ['Mes' => "Abril", 'Total' => $query->total];
                    break;
                Case 5:
                    $meses[5]= ['Mes' => "Mayo", 'Total' => $query->total];
                    break;
                Case 6:
                    $meses[6]= ['Mes' => "Junio", 'Total' => $query->total];
                    break;
                Case 7:
                    $meses[7]= ['Mes' => "Julio", 'Total' => $query->total];
                    break;
                Case 8:
                    $meses[8]= ['Mes' => "Agosto", 'Total' => $query->total];
                    break;
                Case 8:
                    $meses[8]= ['Mes' => "Septiempbre", 'Total' => $query->total];
                    break;
                Case 10:
                    $meses[10]= ['Mes' => "Octubre", 'Total' => $query->total];
                    break;
                Case 11:
                    $meses[11]= ['Mes' => "Noviembre", 'Total' => $query->total];
                    break;
                Case 12:
                    $meses[12]= ['Mes' => "Diciembre", 'Total' => $query->total];
                    break;
            }
        }
        return $meses;
    }
}
