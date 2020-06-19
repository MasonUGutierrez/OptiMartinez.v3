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
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="cedula">Cedula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
                                </div>
                            </div>
                            <div class="col-5">
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