<html lang="es">
{{--Head--}}
<head>

    <title>Sistema</title>
    <link href="/css/app.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/css/librerias/font-awesome/font-awesome.css" rel="stylesheet">
    @yield('extra-css')
</head>

{{-- Body --}}
<body>

@section('extra-javascript')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/font-awesome/dataTables.fontAwesome.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- DataTables -->

    <script type="text/javascript">
        $(document).ready( function () {
            obtengoFacturacionAnual()
            console.log("hola");
        })
        function graficoFacturacion(json) {
            var vendedora = json;
            console.log(vendedora);
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(donut_chart);
            function donut_chart() {
                var data = google.visualization.arrayToDataTable(vendedora);
                var options = {
                    title: 'Facturacion Anual',
                    is3D: true,
                }
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        }
        function obtengoFacturacionAnual(){
            $.ajax({
                url: 'api/reportesDashboard',
                dataType : "json",
                success : function(json) {
                    graficoFacturacion(json);
                }
            });
        }
    </script>
    <body>
    <style type="text/css">
        #linechart{
            float:left;
        }
        #piechart_3d{
            position: relative;
            left: 25%;
        }
    </style>
    <div class="padre">
        <div id="piechart_3d" style="width: 600px; height: 400px;"></div>
    </div>
    </body>

@stop



<div class="content">
    <li></li>
    <li></li>
    <li></li>
    @yield('contenido')
</div>

</body>

@include('partials.footer')
@yield('extra-javascript')


</html>