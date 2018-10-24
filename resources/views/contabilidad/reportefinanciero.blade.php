@extends('layouts.master')
@section('contenido')
    <div class="container">
        <h4>Ingrese Fecha</h4>
        <input type="text" id="fecha" name="fecha" value="{{$año}} " />
        <select name="listaFecha" onChange="combo(this, 'fecha')">
            <option value="2016">2013</option>
            <option value="2016">2014</option>
            <option value="2016">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
        </select>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="panel panel-primary">
                    <div class="panel-heading">Reporte Financiero Anual</div>
                    <div class="panel-body">
                            <table id="reporte" class="table table-striped table-bordered records_list">
                                <thead>
                                <tr>
                                    <th>Mes</th>
                                    <th>Ganancia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datos as $dato)
                                    <tr>
                                        <td data-order = "{{$dato->Fecha}}">{{$dato->Mes}}</td>
                                        <td>{{$dato->Ganancia}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <div id="piechart_ganancias" style="width: 500px; height: 400px";></div>
                        <div id="piechart_facturacion" style="width: 500px; height: 400px ";></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('extra-javascript')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/font-awesome/dataTables.fontAwesome.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- DataTables -->

    <script type="text/javascript">

        $(document).ready( function () {
            $('#reporte').DataTable({
                        dom: 'Bfrtip',
                        "pageLength": 12,
                        "autoWidth": false,
                        buttons: [
                            'excel'
                        ]
                    }

            );
            obtengoGraficoGanancia()
            obtengoGraficoFacturacion()
        } );
        function combo(listaFecha, fecha) {
            fecha = document.getElementById(fecha);
            var idx = listaFecha.selectedIndex;
            var content = listaFecha.options[idx].innerHTML;
            fecha.value = content;
            window.location.replace("../reporteFinanciero?anio=" + fecha.value);
        }
        function obtengoGraficoGanancia(){
            var año  = document.getElementById('fecha').value
            $.ajax({
                url: '/reporteFinancieroGraficoGanancia?anio=' + año,
                dataType : "json",
                success : function(json) {
                    graficoGanancia(json,año);
                }
            });
        }
        function obtengoGraficoFacturacion(){
            var año  = document.getElementById('fecha').value
            $.ajax({
                url: '/reporteFinancieroGraficoFacturacion?anio=' + año,
                dataType : "json",
                success : function(json) {
                    graficoFacturacion(json,año);
                }
            });
        }
        function graficoGanancia(json,año) {
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(donut_chart);
            function donut_chart() {
                var data = google.visualization.arrayToDataTable(json);
                var options = {
                    title: 'Grafico Ganancia Anual ' + año,
                    is3D: true,
                }
                var chart = new google.visualization.PieChart(document.getElementById('piechart_ganancias'));
                chart.draw(data, options);
            }
        }
        function graficoFacturacion(json,año) {
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(donut_chart);
            function donut_chart() {
                var data = google.visualization.arrayToDataTable(json);
                var options = {
                    title: 'Grafico Facturacion Anual ' + año,
                    is3D: true,
                }
                var chart = new google.visualization.PieChart(document.getElementById('piechart_facturacion'));
                chart.draw(data, options);
            }
        }
    </script>
    <style type="text/css">
        #piechart_ganancias{
            float:right;

        }
        #piechart_facturacion{
            float:left;
        }
    </style>
@stop