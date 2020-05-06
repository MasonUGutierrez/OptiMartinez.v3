<div class="modal editJornada" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header mb-2"><h2><strong>Editar</strong> Jornada</h2></div>
                    <div class="row clearfix">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Nombre de la Jornada</label>
                                <input type="hidden" id="idJornada">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="nombre2" class="form-control" placeholder="Nombre...">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tipo de Jornada</label>
                                <select id="tipojornada2" class="form-control show-tick ms select2" data-placeholder="Seleccione un Tipo de Jornada">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" id="fecha2" name="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Lugar de la Jornada</label>
                                <input type="text" id="lugar2" name="" class="form-control" placeholder="Lugar..."/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select id="depas2" class="form-control show-tick ms select2" data-placeholder="Seleccione un Departamento">
                                    <option></option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar" data-dismiss="modal"
                        onclick="saveData()">Guardar
                </button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="clearData2()" type="reset">Cancelar</button>
                </a>
            </div>

        </div>
    </div>
</div>
