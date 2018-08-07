@extends('layouts.master')
@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-cog">Pedidos</i></div>
                    <div class="panel-body">
                        <div>
                            Seleccionar Columnas:
                            <a class="toggle-vis" data-column="0">NroPedido</a> -
                            <a class="toggle-vis" data-column="1">Cliente</a> -
                            <a class="toggle-vis" data-column="2">Fecha</a> -
                            <a class="toggle-vis" data-column="3">Vendedora</a> -
                            <a class="toggle-vis" data-column="4">Factura</a> -
                            <a class="toggle-vis" data-column="5">Estado</a>
                        </div>
                            <table id="reporte" class="table table-striped table-bordered records_list">
                                <thead>
                                <tr>
                                    <th>NroPedido</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Vendedora</th>
                                    <th>Factura</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr>
                                        <td>{{$pedido->nropedido}}</td>
                                        <td>{{$pedido->nombre}}, {{$pedido->apellido}}</td>
                                        <td>{{$pedido->fecha}}</td>
                                        <td>{{$pedido->vendedora}}</td>
                                        <td>{{$pedido->nrofactura}}</td>
                                        @if ($pedido->estado == 0)
                                            <td bgcolor="#00FF00">Facturado</td>
                                            <td><input type="button" value="Ver" class="btn btn-info" onclick="cargoTablaPopup({{$pedido->nropedido}});">
                                            <input type="button" value="cancel"  disabled class="btn btn-warning" onclick="calcelarPedido({{$pedido->nropedido}});" >
                                            <button id="botonComent" value="Comentario" class="btn btn-success" onclick="comentario({{$pedido->id}},'{{$pedido->nropedido}}','{{$pedido->nombre}}','{{$pedido->apellido}}');"><i class="fa fa-book"></i></button></td>
                                        @elseif($pedido->estado == 1)
                                            <td bgcolor="#FFFF00">Procesando</td>
                                            <td><input type="button" value="Ver" class="btn btn-info" onclick="cargoTablaPopup({{$pedido->nropedido}});">
                                            <input type="button" value="cancel" class="btn btn-warning" onclick="calcelarPedido({{$pedido->nropedido}});" >
                                            <button id="botonComent" value="Comentario" class="btn btn-success" onclick="comentario({{$pedido->id}},'{{$pedido->nropedido}}','{{$pedido->nombre}}','{{$pedido->apellido}}');"><i class="fa fa-book"></i></button></td>
                                        @else
                                            <td bgcolor="#FF0000">Cancelado</td>
                                            <td><input type="button" value="Ver" class="btn btn-info" onclick="cargoTablaPopup({{$pedido->nropedido}});">
                                            <input type="button" value="cancel"  disabled class="btn btn-warning" onclick="calcelarPedido({{$pedido->nropedido}});" >
                                            <button id="botonComent" value="Comentario" class="btn btn-success" onclick="comentario({{$pedido->id}},'{{$pedido->nropedido}}','{{$pedido->nombre}}','{{$pedido->apellido}}');"><i class="fa fa-book"></i></button></td>
                                        @endif
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
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
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

        .table-scroll tbody {
            position: absolute;
            overflow-y: scroll;
            height: 350px;
        }

        .table-scroll tr {
            width: 100%;
            table-layout: fixed;
            display: inline-table;
        }

        .table-scroll thead > tr > th {
            border: none;
        }

        #general{
            margin: auto;
            margin-top: 10px;
            width: auto;
            height: auto;
        }
        #mensajes{
            width: 550px;
            height: 300px;
        }
        #nuevomensajes{
            float: right;
            width: 300px;
            height: 300px;
        }
        .textarea{
            width: 300px;
            height: 120px;
            border: 3px solid #cccccc;
            padding: 5px;
            font-family: Tahoma, sans-serif;
            background-position: bottom right;
            background-repeat: no-repeat;
            resize: none;
        }
    </style>

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        /* The Modal (background) */
        #myModalComentarios {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        /* Modal Content */
        #modal-content-comentarios {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 3px solid #888;
            width: 70%;
            overflow-y: auto;
        }
    </style>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Nº Pedido: </h3>
            <div class="col-xs-12 col-xs-offset-0 well">
                <table id="pedidos" class="table table table-scroll table-striped">
                    <thead>
                    <tr>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <!-- The Modal Comentarios-->
    <div id="myModalComentarios" class="modal">

        <!-- Modal content -->
        <div id="modal-content-comentarios" class="modal-content">
            <span class="close1">&times;</span>
            <h3>Nº Pedido: </h3>
            <h5 id="cliente"></h5>
            <div id="general">
                <div id="nuevomensajes">
                    <textarea id="textarea" class="textarea is-warning" type="text" placeholder="Escriba una nota" rows="10"></textarea>
                    <div id="botones">
                        <button id="agregar"  class="btn btn-primary" onclick="agregarNota({{$user_id}});"><i class="fa fa-check"></i></button>
                        <button id="botoncerrar" class="btn btn-success" onclick="cerrar();"><i class="fa fa-close"></i></button>
                    </div>
                </div>
                <div id="mensajes">
                    <div class="col-xs-12 col-xs-offset-0 well">
                        <table id="comentarios" class="table table table-scroll table-striped">
                            <thead>
                                <tr>

                                </tr>
                            </thead>
                        </table>
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
        var glonalNroControlPedido
        $(document).keyup(function(e) {
            if (e.keyCode == 27) { // escape key maps to keycode `27`
                cerrar()
            }
        });
        $(document).ready( function () {
            $(document).ready( function () {
                var table =  $('#reporte').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'excel'
                            ],

                        }

                );
                $('a.toggle-vis').on( 'click', function (e) {
                    e.preventDefault();

                    // Get the column API object
                    var column = table.column( $(this).attr('data-column') );

                    // Toggle the visibility
                    column.visible( ! column.visible() );
                } );
            } );
        } );

        function cargoTablaPopup(nroPedido){
            var table = $("#pedidos");
            table.children().remove()
            table.append("<thead><tr><th>Articulo</th><th>Detalle</th><th>Cantidad</th><th>Vendedora</th></tr></thead>")
            $.ajax({
                url: '/api/listaPedidosWeb?nroPedido=' + nroPedido,
                dataType : "json",
                success : function(json) {
                    console.log(json)
                    $.each(json, function(index, json){
                        console.log(json['Vendedora'])
                        table.append("<tr><td>"+json['Articulo']+"</td><td>"+json['Detalle']+
                                     "</td><td>"+json['Cantidad']+"</td><td>"+json['Vendedora']+"</td></tr>");
                    });
                }
            });
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
            $(".modal-content h3").html("Pedido Nº:" + nroPedido);
        }

        function calcelarPedido (nroPedido){
            if (confirm("Esta seguro que quiere cancelar el pedido Nº " + nroPedido + "?")){
                $.ajax({
                    url: '/api/cancelarPedido?nroPedido=' + nroPedido,
                    dataType : "json",
                    success : function(json) {
                        location.reload();
                    }
                });
            } else {

            }
        }

        function comentario(controlpedidos_id,nroPedido,nombre_cliente,apellido_cliente){
            glonalNroControlPedido = controlpedidos_id
            var table = $("#comentarios");
            table.children().remove()
            table.append("<thead><tr><th>Usuario</th><th>Comentarios</th><th>Fecha</th></tr></thead>")
            $.ajax({
                url: '/api/comentarios?controlpedidos_id=' + controlpedidos_id,
                dataType : "json",
                success : function(json) {
                    $.each(json, function(index, json){
                        table.append("<tr><td>"+json['nombre']+"</td><td>"+json['comentario']+
                                "</td><td>"+json['fecha']+"</td>"+ "</tr>");
                    });
                }
            });
            // Get the modal
            var modalComentario = document.getElementById('myModalComentarios');

            // Get the <span> element that closes the modal
            var spanComentario = document.getElementsByClassName("close1")[0];

            // When the user clicks the button, open the modal
            modalComentario.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            spanComentario.onclick = function() {
                modalComentario.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modalComentario) {
                    modalComentario.style.display = "none";
                }
            }
            $(".modal-content h3").html("Pedido Nº:" + nroPedido);
            $(".modal-content #cliente").html( nombre_cliente + "," + apellido_cliente);
        }

        function cerrar(){
            // Get the modal
            var modalComentario = document.getElementById('myModalComentarios');
            // When the user clicks on <span> (x), close the modal
                modalComentario.style.display = "none";
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modalComentario) {
                    modalComentario.style.display = "none";
                }
            }
            document.getElementById("textarea").value = "";
        }

        function agregarNota(user_id){
            var textarea = $.trim($("textarea").val());
            if (textarea != ""){
                $.ajax({
                    url: '/api/agregarcomentarios?nroControlPedido=' + glonalNroControlPedido + "&" +
                    'user_id=' + user_id + "&" + 'textarea=' + textarea,
                    dataType : "json",
                    success : function(json) {
                        console.log(json)
                        document.getElementById("textarea").value = "";
                        refreshfunctionComentario()
                    }
                });
            } else alert("Debe agregar una nota")

        }

        function refreshfunctionComentario(){
            var table = $("#comentarios");
            table.children().remove()
            table.append("<thead><tr><th>Usuario</th><th>Comentarios</th><th>Fecha</th></tr></thead>")
            $.ajax({
                url: '/api/comentarios?controlpedidos_id=' + glonalNroControlPedido,
                dataType : "json",
                success : function(json) {
                    $.each(json, function(index, json){
                        table.append("<tr><td>"+json['nombre']+"</td><td>"+json['comentario']+
                                "</td><td>"+json['fecha']+"</td>"+ "</tr>");
                    });
                }
            });
        }
    </script>


@stop