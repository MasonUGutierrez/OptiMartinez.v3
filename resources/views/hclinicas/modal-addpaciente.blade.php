<div class="modal fade" id="AddPaciente" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header"></div> --}}
            <div class="modal-body">
                <div class="card">
                    <div class="header">
                        <h2><strong>Datos</strong> Paciente</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" id="nombre" name="nombres" class="form-control" placeholder="Nombres">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" id="apellido" name="apellidos" class="form-control" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="fecha_nacimiento"> Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" readonly class="form-control" min="0" max="200" id="edad" name="edad" placeholder="Edad">
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-sm-12">
                                <div>
                                    <label for="">Sexo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sexoRadio1" name="sexo" class="custom-control-input" checked value="masculino">
                                    <label class="custom-control-label" for="sexoRadio1">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                   <input type="radio" id="sexoRadio2" name="sexo" class="custom-control-input" value="femenino">
                                   <label class="custom-control-label" for="sexoRadio2">Femenino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <label for="cedula">Cedula</label> 
                                        </div>
                                        <div class="col-md-6">
                                            {{-- Checkbox para confirmar si es menor de edad --}}
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkMenor">
                                                <label class="custom-control-label" for="checkMenor">
                                                    Menor de Edad
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type="checkbox"> --}}
                                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="direccion">Dirección</label>
                                <textarea class="form-control format-textarea" id="direccion" name="direccion" placeholder="Direccion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Datos</strong> Historia Clinica</h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <label for="antecedente">Antecedentes</label>
                            <textarea class="form-control format-textarea" id="antecedentes" name="antecedentes" placeholder="Antecedentes del Paciente"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-raised btn-round waves-effect waves-light" id="Guardar" data-dismiss="modal" value="Aceptar">
                    <input type="button" class="btn btn-danger btn-raised waves-effect waves-light" data-dismiss="modal" value="Cancelar">
                </div>
            </div>
        </div>
    </div>
</div>