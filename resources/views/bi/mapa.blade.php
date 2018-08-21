@extends('layouts.master')
@section('contenido')

    <body>
    <div class="container">

        <h1>Facturacion 2018</h1>

        <div class="mapcontainer">
            <div class="map">
            </div>
            <div class="areaLegend">
            </div>
        </div>
    </div>


    </body>
@stop
@section('extra-javascript')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"
            charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js" charset="utf-8"></script>
    <script src="../../js/jquery.mapael.js" charset="utf-8"></script>
    <script src="../../js/maps/argentina.js" charset="utf-8"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $.ajax({
                url: '/mapadatos',
                dataType: "json",
                success: function (json) {
                    cargaMapa(json)
                }
            })
        });
        function cargaMapa (json) {
           // json1 = [{"CABA":{ "value": "3000","tooltip":{"content": "Facturacion 3000"}}}];
            $(function () {
                $(".mapcontainer").mapael({
                    map: {
                        name: "argentina",
                        defaultArea: {
                            attrs: {
                                stroke: "#fff",
                                "stroke-width": 1
                            },
                            attrsHover: {
                                "stroke-width": 2
                            }
                        }
                    },
                    legend: {
                        area: {
                            title: "",
                            slices: [
                                {
                                    max: 300000,
                                    attrs: {
                                        fill: "#97e766"
                                    },
                                    label: "Facturacion en la Region"
                                },
                            ]
                        }
                    },

                areas: json
                });
            });

        };


    </script>
    <style type="text/css">
        body {
            color: #5d5d5d;
            font-family: Helvetica, Arial, sans-serif;
        }
        h1 {
            font-size: 30px;
            margin: auto;
            margin-top: 50px;
        }
        .container {
            max-width: 400px;
            margin: auto;
        }
        /* Specific mapael css class are below
         * 'mapael' class is added by plugin
        */
        .mapael .map {
            position: relative;
        }
        .mapael .mapTooltip {
            position: absolute;
            background-color: #fff;
            moz-opacity: 0.70;
            opacity: 0.70;
            filter: alpha(opacity=70);
            border-radius: 10px;
            padding: 10px;
            z-index: 1000;
            max-width: 200px;
            display: none;
            color: #343434;
        }
    </style>

@stop