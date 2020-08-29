<!-- Modal -->
<div class="modal fade" id="calendarModalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body center ">
                <div class="card">
                    <div class="header mb-2"><h2><strong>Agendar</strong> Jornada</h2></div>
                    <input type="hidden" id="trucazo" value="">
                    <input type="hidden" id="id_jornada_trabajo">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de Jornada</label>
                                <select id="tipoJornadaID2" class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select id="departamentoID2" class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nombre de la Jornada</label>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="nombreJornadaID2" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Direccion de la Jornada</label>
                                <input type="text" id="direccionJornadaID2" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" id="fechaInicio2"  class="form-control"/>
                            </div>
                        </div>
                        {{--<div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                </div>
                                <input type="text" class="form-control timepicker" placeholder="Please choose a time...">
                            </div>
                        </div>--}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appt-time">Hora</label>
                                <input id="horaInicio2" type="time"  class="form-control" name="appt-time">
                            </div>
                        </div>
                        {{--<div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Finalizacion</label>
                                <input type="date"  id="fechaFinal"  class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="appt-time">Hora de Finalizacion</label>
                                    <input id="horaFinal" class="form-control" type="time" name="appt-time" >
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnpruebas2" onclick="" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
