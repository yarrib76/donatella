@extends('layouts.master')
@section('contenido')
    <div>
        <body>
        <br/>
        <br/>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title" style="padding:12px 0px;font-size:25px;"><strong>Sincronizar Articulos con Tienda Nube</strong></h3>
                </div>
                <div class="panel-body" id="sincro">
                    <input type="button" value="Sincronizar" class="btn btn-success" onclick="sincro()">
                </div>
            </div>
        </div>

        </body>
    </div>

    <style>
        #myModal {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            width: 11%;
            height: 20%;
            overflow-y: auto;
        }
    </style>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <img src="refresh/load.gif" height="100" width="100">
        </div>

    </div>
    <script>
        function sincro(){
            // Get the modal
            var modal = document.getElementById('myModal');
            // When the user clicks the button, open the modal
            modal.style.display = "block";
            $.ajax({
                url: '/api/tiendanube',
                dataType : "json",
                success : function(json) {
                    console.log(json)
                    //close the modal
                    modal.style.display = "none";
                }
            });
        }
    </script>
@stop