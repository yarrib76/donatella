@extends('layouts.master')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-sm-15 ">
                <div class="panel panel-primary">
                    <div class="panel-heading">Promociones {{$tipo}} para: {{$cliente}} </div>
                    <div class="panel-body">
                        <table id="reporte" class="table table-striped table-bordered records_list">
                            <thead>
                            <tr>
                                <th>Fecha Creacion</th>
                                <th>Fecha Vencimiento</th>
                                <th>Promocion</th>
                                <th>Codigo Autorizacion</th>
                                @if($tipo === "en espera")
                                    <th>Accion</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promociones as $promocion)
                                <tr>
                                    <td>{{$promocion->FechaCreacion}}</td>
                                    <td>{{$promocion->FechaVencimiento}}</td>
                                    <td>{{$promocion->Detalle}}</td>
                                    <td>{{$promocion->CodAutorizacion}}</td>
                                    @if($tipo === "en espera")
                                        <td><input type="button" id="activar" value="Activar" class="btn btn-primary" onclick="activar({{$promocion->Promocion_Id}})"></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="/panelpromocion" type="submit" class="btn btn-primary" name="agregar"> Volver</a>
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
    <!-- DataTables -->

    <script type="text/javascript">
        $(document).ready( function () {
            var table =  $('#reporte').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                                ]
                    }

            );
        } );

        function activar (promocion_id){
            $.ajax({
                url: 'activarpromocion?nropromocion=' + promocion_id,
                dataType: "json",
                success: function (json) {
                    location.reload();
                }
            });
        }
    </script>
@stop