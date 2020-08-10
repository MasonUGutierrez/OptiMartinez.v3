<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body center ">
                <div class="card">
                    <div class="header mb-2"><h2><strong>Agendar</strong> Jornada</h2></div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de Jornada</label>
                                <select id="tipoJornadaID" class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select id="departamentoID" class="form-control show-tick ms select2"><option></option></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nombre de la Jornada</label>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="nombreJornadaID" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Direccion de la Jornada</label>
                                <input type="text" id="direccionJornadaID" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de inicio</label>
                                <input type="date" id="fechaInicio"  class="form-control"/>
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
                                    <label for="appt-time">Hora de Inicio</label>
                                    <input id="horaInicio" type="datetime-local" class="form-control" name="appt-time" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Finalizacion</label>
                                <input type="date"  id="fechaFinal"  class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="appt-time">Hora de Finalizacion</label>
                                    <input id="horaFinal" class="form-control" type="time" name="appt-time" step="2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnpruebas" onclick="guardarJornada()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
