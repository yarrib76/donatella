@extends('layouts.master')
@section('contenido')
    <div class="container">
                <h4>Ingrese Fecha</h4>
                <input type="text" id="fecha" name="fecha" value="{{$año}} " />
                <select name="listaFecha" onChange="combo(this, 'fecha')">
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
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-cog">Clientes</i></div>
                            <div class="panel-body">
                                    <table id="reporte" class="table table-striped table-bordered records_list">
                                        <thead>
                                        <tr>
                                            <th>Clientes</th>
                                            <th>Facturado</th>
                                            <th>Meses</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr>
                                                <td>{{$cliente->Cliente}}</td>
                                                <td>{{$cliente->Total}}</td>
                                                <td><p><span class="w3-badge">{{$cliente->Meses}}</span></p></td>
                                                <td><input type="button" value="Graficar" class="btn btn-info" onclick="obtengoFacturacionMensual({{$cliente->Id}},'{{$cliente->Cliente}}');">
                                                    {!! Html::linkRoute('biclientearticulos.index', 'Ver', ['Cliente_ID'=>$cliente->Id,'anio' => $año] , ['class' => 'btn btn-primary'] ) !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 25%;
            top: 15%;
            width: 50%; /* Full width */
            height: 80%; /* Full height */
            overflow: auto ; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }


        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            height: 100%;
            top: -10%;
            overflow-y: auto;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .well {
            background: none;
            height: 420px;
        }
    </style>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="col-xs-12 col-xs-offset-0 well">
                <div id="piechart_3d" style="width: 500px; height: 300px;"></div>
            </div>
        </div>

    </div>

@stop
@section('extra-javascript')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.6/integration/font-awesome/dataTables.fontAwesome.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../../css/numredondos.css">
    <!-- DataTables -->

    <script type="text/javascript">
        $(document).keyup(function(e) {
            if (e.keyCode == 27) { // escape key maps to keycode `27`
                cerrar()
            }
        });
        $(document).ready( function () {
            $('#reporte').DataTable({

                        "lengthMenu": [ [8,  16, 32, -1], [8, 16, 32, "Todos"] ],
                        language: {
                            search: "Buscar:",
                            "thousands": ",",
                            processing:     "Traitement en cours...",
                            lengthMenu:    "Mostrar _MENU_ clientes",
                            info:           "Mostrando del  _START_ al _END_ de _TOTAL_ clientes",
                            infoEmpty:      "0 clientes",
                            infoFiltered:   "(Filtrando _MAX_ clientes en total)",
                            infoPostFix:    "",
                            loadingRecords: "Chargement en cours...",
                            zeroRecords:    "No se encontraron clientes para esa busqueda",
                            emptyTable:     "No existen clientes",
                            paginate: {
                                first:      "Primero",
                                previous:   "Anterior",
                                next:       "Proximo",
                                last:       "Ultimo"
                            }
                        },
                        order: [2,'asc']
                    }

            );
        } );

    </script>
    <script type="text/javascript">
        function grafico(json, id_cliente,nbreCliente) {
            console.log(json)
            var cliente = json;
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(donut_chart);
            function donut_chart() {
                var data = google.visualization.arrayToDataTable(cliente);
                var options = {
                    title: 'Facturaciòn del cliente: ' + nbreCliente + ' año ' + fecha.value,
                    is3D: true,

                }
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            modal.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
        function obtengoFacturacionMensual(id_cliente,nbreCliente){
            $.ajax({
                url: 'biclientes?id_cliente=' + id_cliente + "&anio=" + fecha.value,
                dataType : "json",
                success : function(json) {
                    grafico(json, id_cliente,nbreCliente);
                }
            });
        }
        function combo(listaFecha, fecha) {
            fecha = document.getElementById(fecha);
            var idx = listaFecha.selectedIndex;
            var content = listaFecha.options[idx].innerHTML;
            fecha.value = content;
            window.location.replace("../api/biclientes?anio=" + fecha.value);

        }

        function cerrar(){
            // Get the modal
            var modalComentario = document.getElementById('myModal');
            // When the user clicks on <span> (x), close the modal
            modalComentario.style.display = "none";
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modalComentario) {
                    modalComentario.style.display = "none";
                }
            }
        }

    </script>
    <body>
    <style type="text/css">
        #piechart_3d{
        }
    </style>
    </body>

@stop