<?php

namespace Donatella\Http\Controllers\Contabilidad;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Donatella\Http\Requests;
use Donatella\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReporteFinanciero extends Controller
{
    public function query()
    {
        $año = Input::get('anio');
        if (empty($año)){
            $año = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->year;
            $datos = $this->getData($año);
            return view('contabilidad.reportefinanciero', compact('datos','año'));
        }
        $datos = $this->getData($año);
        return view('contabilidad.reportefinanciero', compact('datos','año'));
    }

    public function getData($año)
    {
        DB::statement("SET lc_time_names = 'es_ES'");
        $query = DB::select('SELECT UPPER(DATE_FORMAT(fecha, "%M")) as Mes, ROUND(sum(Ganancia),2) As Ganancia, Fecha
                                FROM samira.facturah
                                WHERE fecha >=  "' . $año .'/01/01" and Fecha <= "' . $año .'/12/31"
                                GROUP BY Mes
                                ORDER BY fecha asc;');
        return $query;
    }

    public function getDataGraficoGanancia()
    {
        $año = Input::get('anio');
        if (empty($año)) {
            $año = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->year;
        }

        DB::statement("SET lc_time_names = 'es_ES'");
        $query = DB::select('SELECT UPPER(DATE_FORMAT(fecha, "%M")) as Mes, ROUND(sum(Ganancia),2) As Ganancia, Fecha
                                FROM samira.facturah
                                WHERE fecha >=  "' . $año .'/01/01" and Fecha <= "' . $año .'/12/31"
                                GROUP BY Mes
                                ORDER BY fecha asc;');
        $result[] = ['Mes','Total'];
        foreach ($query as $key => $value) {
            $result[++$key] = [$value->Mes, (int)$value->Ganancia];
        }
        return $result;
    }

    public function getDataGraficoFacturacion()
    {
        $año = Input::get('anio');
        if (empty($año)){
            $año = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->year;
        }
        DB::statement("SET lc_time_names = 'es_ES'");
        $query = DB::select('SELECT DATE_FORMAT(fecha, "%M") AS Mes, ROUND(SUM(CASE WHEN Descuento <> "null" OR Descuento = 0 THEN Descuento ELSE total END),2) as total
                            from samira.facturah where fecha >= "' . $año .'/01/01" and Fecha <= "' . $año .'/12/31"
                            group by Mes
                            ORDER BY fecha asc');
        $result[] = ['Mes','Total'];
        foreach ($query as $key => $value) {
            $result[++$key] = [$value->Mes, (int)$value->total];
        }
        return $result;
    }
}
