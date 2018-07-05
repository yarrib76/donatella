@extends('layouts.master')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-cog">Clientes</i></div>
                    <div class="panel-body">
                            <table id="reporte" class="table table-striped table-bordered records_list">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Apodo</th>
                                    <th>Cuit</th>
                                    <th>Direccion</th>
                                    <th>Mail</th>
                                    <th>Telefono</th>
                                    <th>Localidad</th>
                                    <th>Provincia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{$cliente->nombre}}</td>
                                        <td>{{$cliente->apellido}}</td>
                                        <td>{{$cliente->apodo}}</td>
                                        <td>{{$cliente->cuit}}</td>
                                        <td>{{$cliente->direccion}}</td>
                                        <td>{{$cliente->mail}}</td>
                                        <td>{{$cliente->telefono}}</td>
                                        <td>{{$cliente->localidad}}</td>
                                        <td>{{$cliente->provincia}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <a href='{{ route('clientes.create') }}' class = 'btn btn-primary'>Crear Cliente</a>
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
            $('#reporte').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ]
                    }

            );
        } );
    </script>
@stop