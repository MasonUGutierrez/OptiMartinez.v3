<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <div class="card mb-0">
                    <div class="header">
                        <h2><strong>Agendar</strong> Jornadas</h2>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body center ">
                <div class="card">
                    {{--<div class="header mb-2"><h2><strong>Agendar</strong> Jornada</h2></div>--}}

                    <input type="hidden" id="trucazo" value="">
                    <input type="hidden" id="id_jornada_trabajo">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de Jornada</label>
                                <select id="tipoJornadaID" disabled class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select id="departamentoID" disabled class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nombre de la Jornada</label>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="nombreJornadaID" readonly class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Direccion de la Jornada</label>
                                <input type="text" id="direccionJornadaID" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" id="fechaInicio" readonly class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appt-time">Hora</label>
                                <input id="horaInicio" type="time" readonly class="form-control" name="appt-time">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" id="closeButton" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>--}}
                 <button type="button" id="btnEditar" class="btn btn-primary">Editar</button>
                <button type="button" id="btnpruebas" hidden class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" id="delButton" >Eliminar</button>
                <button type="button" class="btn btn-danger" hidden id="cancelButton">Cancelar</button>
            </div>
        </div>
    </div>
</div>
