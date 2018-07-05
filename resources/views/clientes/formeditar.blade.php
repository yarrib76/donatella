<div class="col-lg-15" style="margin-top:2px;">
    <div class="col-sm-8 col-sm-offset-3">
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Nombre" value="{{$cliente->nombre}}" name="Nombre" required="required">
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Apellido" value="{{$cliente->apellido}}" name="Apellido" required="required">
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Apodo" value="{{$cliente->apodo}}" name="Apodo">
            </div>

            <div class="col-sm-9">
                <input type="number" class="form-control" placeholder="Cuit" value="{{$cliente->cuit}}" name="Cuit" >
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Direccion" value="{{$cliente->direccion}}" name="Direccion">
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Localidad" value="{{$cliente->localidad}}" name="Localidad">
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Provincia" value="{{$cliente->provincia}}" name="Provincia">
            </div>

            <div class="col-sm-9">
                <input type="email" class="form-control" placeholder="Mail" name="Mail" value="{{$cliente->mail}}" required="required">
            </div>

            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Telefono" value="{{$cliente->telefono}}" name="Telefono">
            </div>

        <input type="hidden" class="form-control" value="{{$cliente->id_clientes}}" name="id">

    </div>
</div>

