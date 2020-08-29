<div class="modal fade" id="AddPaciente" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card mb-0">
                    <div class="header">
                        <h2><strong>Datos</strong> Personales</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            {{-- Input para el nombre --}}
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" id="nombre" name="nombres" class="form-control" placeholder="Nombres">
                                </div>
                            </div>
                            {{-- Input para los apellidos --}}
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" id="apellido" name="apellidos" class="form-control" placeholder="Apellidos">
                                </div>
                            </div>
                            {{-- Input para la fecha de nacimiento --}}
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="fecha_nacimiento"> Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
                                </div>
                            </div>
                            {{-- Input deshabilitado para mostrar la edad --}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" disabled class="form-control" min="0" max="200" id="edad" name="edad" placeholder="Edad">
                                </div>
                            </div>
                            {{-- Input Checkbox para indicar el sexo --}}
                            <div class="col-md-5 col-sm-12">
                                <div><label for="">Sexo</label></div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sexoRadio1" name="sexo" class="custom-control-input" checked value="masculino">
                                    <label class="custom-control-label" for="sexoRadio1">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sexoRadio2" name="sexo" class="custom-control-input" value="femenino">
                                    <label class="custom-control-label" for="sexoRadio2">Femenino</label>
                                </div>
                            </div>
                            {{-- Input para la cedula --}}
                            <div class="col">
                                <div class="form-group">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <label for="cedula">Cedula</label>
                                        </div>
                                        {{-- Checkbox para confirmar si es menor de edad --}}
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkMenor">
                                                <label class="custom-control-label" for="checkMenor">
                                                    <small>Menor de Edad</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
                                </div>
                            </div>
                            {{-- Input para el telefono --}}
                            <div class="col">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                                </div>
                            </div>
                            {{-- Textarea para la direccion --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <textarea class="form-control no-resize" rows="4" id="direccion" name="direccion" placeholder="Direccion"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-raised btn-round waves-effect waves-light" id="Guardar" data-dismiss="modal" value="Aceptar">
                    <input type="button" class="btn btn-danger btn-raised waves-effect waves-light" data-dismiss="modal" value="Cancelar" id="btnCancel">
                </div>
            </div>
        </div>
    </div>
</div>
