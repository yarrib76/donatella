<div class="col-lg-20" style="margin-top:2px;">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="col-xs-2 col-sm-2 col-md-2 ">
            <h4>7798</h4>
        </div>
        <div class="col-xs-9 col-sm-9 col-md-9">
            <input type="number" class="form-control" placeholder="Numero de Articulo" name="Articulo" min="-99999999" max="99999999">
        </div>

        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Detalle" name="Detalle">
        </div>

        <div class="col-sm-9">
            <input type="number" class="form-control" placeholder="Cantidad" name="Cantidad" min="-99999999" max="99999999">
            <input type="number" step="any" class="form-control" placeholder="Precio de Origen" name="PrecioOrigen">
            <input type="number" step="any" class="form-control" placeholder="Precio Convertido" name="PrecioConvertido" id="PrecioConvertido">
            <label>
                <input type="radio" name="Opciones" id="Dolares" value="opcion_dolares" checked>
                Dolares
            </label>
            <label>
                <input type="radio" name="Opciones" id="Pesos" value="opcion_pesos">
                Pesos
            </label>
            <label>
                <input type="radio" name="Opciones" id="Manual" value="opcion_manual">
                Manual
            </label>
        </div>
    </div>
    <div class="col-sm-9">
        <input type="number" step="any" class="form-control" placeholder="Manual" name="Manual" id="InputManual" disabled="true">
        <input type="number" step="any" class="form-control" placeholder="Gastos" name="Gastos" id="Gastos" disabled="true">
        <input type="number" step="any" class="form-control" placeholder="Ganancia" name="Ganancia" id="Ganancia" disabled="true">
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $("#Dolares").click(function() {
        $("#PrecioCOnvertido").prop("required", false);
        $("#InputManual").prop("disabled", true);
        $("#Gastos").prop("disabled", true);
        $("#Ganancia").prop("disabled", true);
        console.log('Hola');
    });
    $("#Pesos").click(function() {
        $("#PrecioCOnvertido").prop("required", false);
        $("#InputManual").prop("disabled", true);
        $("#Gastos").prop("disabled", true);
        $("#Ganancia").prop("disabled", true);
    });
    $("#Manual").click(function() {
        $("#InputManual").prop("disabled", false);
        $("#Gastos").prop("disabled", false);
        $("#Ganancia").prop("disabled", false);
        $("#PrecioConvertido").prop("disabled", true);
        console.log('HolaManual');
    });
</script>