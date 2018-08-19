@extends('layouts.master')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-sm-15 ">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>Mapa</h4></div>
                    <div class="panel-body">
                        <head>

                        </head>
                        <body>
                            <div id="mapa" style="height:315px;"></div>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('extra-javascript')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="http://www.ign.gob.ar/argenmap/argenmap.jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#mapa").argenmap().centro(-34,-59);
        });
    </script>
@stop