<div class="modal newConsulta" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header mb-2"><h2><strong>Nueva</strong> Consulta</h2></div>
                            <div class="row clearfix">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label>Nombre del Cliente</label>
                                        <input type="text" readonly id="nombreCliente" class="form-control"
                                               placeholder="Nombre...">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" id="fecha" readonly class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre de Jornada</label>
                                        <select  id="jornadaNombres" class="form-control show-tick ms select2" data-placeholder="Seleccione Jornada...">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header mb-2 ml-3"><h2><strong>Examen</strong> Visual</h2></div>
                            <div class="row clearfix">
                                <div class=" col-lg-8 col-md-12">
                                    <table id="mainTable" style="text-align: center"
                                           class="table table-striped table-bordered c_table">
                                        <thead>
                                        <tr>
                                            <th>Ojo</th>
                                            <th>Esfera</th>
                                            <th>Cilindro</th>
                                            <th>Eje</th>
                                            <th>Adición</th>
                                            <th>Agudeza Visual</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>O.D</th>
                                            <td id="esd">0.0</td>
                                            <td id="cd">0.0</td>
                                            <td id="ejd">0.0</td>
                                            <td id="ad">0.0</td>
                                            <td id="avd">0.0</td>
                                        </tr>
                                        <tr>
                                            <th>O.I</th>
                                            <td id="esi">0.0</td>
                                            <td id="ci">0.0</td>
                                            <td id="eji">0.0</td>
                                            <td id="ai">0.0</td>
                                            <td id="avi">0.0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" col-lg-4 col-md-12">
                                    <table id="mainTable2" style="text-align: center"
                                           class="table table-bordered table-striped c_table">
                                        <thead>
                                        <tr>
                                            <th>D.P.</th>
                                            <th>Alt.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td id="dp">0.0</td>
                                            <td id="alt">0.0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row clearfix">
                                <div class="header mb-2 ml-3 col-sm-12"><h2><strong>Observaciones</strong></h2></div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <textarea id="observ" rows="4" class="form-control no-resize"
                                                        placeholder="Observaciones..."></textarea>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header mb-2 ml-1 col-sm-12"><h2><strong>Retinoscopia</strong></h2></div>
                            <div class="checkbox">
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input id="checkbox12"  type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="checkbox12">
                                            Seleccione para mostrar campo.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <textarea id="hallazgo" rows="4" class="form-control no-resize"
                                              placeholder="Hallazgos de Retinoscopia..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar" data-dismiss="modal"
                        onclick="newConsulta()">Guardar
                </button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="clearData()" type="reset">Cancelar
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
