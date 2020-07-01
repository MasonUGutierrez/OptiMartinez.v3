<div class="modal newJornada" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header mb-2"><h2><strong>Nueva</strong> Jornada</h2></div>
                    <div class="row clearfix">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Nombre de la Jornada</label>
                                <input type="text" id="nombre" class="form-control" placeholder="Nombre...">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tipo de Jornada</label>
                                <select id="tipojornada" class="form-control show-tick ms select2" data-placeholder="Seleccione un Tipo de Jornada">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" id="fecha" name="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Lugar de la Jornada</label>
                                <input type="text" id="lugar" name="" class="form-control" placeholder="Lugar..."/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select id="depas" class="form-control show-tick ms select2" data-placeholder="Seleccione un Departamento">
                                    <option></option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar" data-dismiss="modal"
                        onclick="saveJornada()">Guardar
                </button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="clearData()" type="reset">Cancelar</button>
                </a>
            </div>

        </div>
    </div>
</div>
