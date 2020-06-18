<div class="modal showConsulta" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header mb-2"><h2><strong>Editar</strong> Consulta</h2></div>
                            <input type="hidden" id="idconsulta">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row clearfix">
                                {{--<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="text" id="fe" readonly class="form-control"/>
                                    </div>
                                </div>--}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre de Jornada</label>
                                        <select  id="jor"  class="form-control show-tick ms select2"  data-placeholder="Seleccione Jornada...">
                                            <option></option>
                                        </select>
                                        {{--<input type="text" id="jor" readonly class="form-control" >--}}
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
                                    <table id="mainTable3" style="text-align: center"
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
                                            <td id="esd1">0.0</td>
                                            <td id="cd1">0.0</td>
                                            <td id="ejd1">0.0</td>
                                            <td id="ad1">0.0</td>
                                            <td id="avd1">0.0</td>
                                        </tr>
                                        <tr>
                                            <th>O.I</th>
                                            <td id="esi1">0.0</td>
                                            <td id="ci1">0.0</td>
                                            <td id="eji1">0.0</td>
                                            <td id="ai1">0.0</td>
                                            <td id="avi1">0.0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" col-lg-4 col-md-12">
                                    <table id="mainTable4" style="text-align: center"
                                           class="table table-bordered table-striped c_table">
                                        <thead>
                                        <tr>
                                            <th>D.P.</th>
                                            <th>Alt.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td id="dp1">0.0</td>
                                            <td id="alt1">0.0</td>
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
                                    <textarea id="observa" rows="4" class="form-control no-resize"
                                              placeholder="Observaciones..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix " id="textarea" hidden>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header mb-2 ml-1 col-sm-12"><h2><strong>Retinoscopia</strong></h2></div>
                            <div class="checkbox">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input id="checkbox14"  type="checkbox">
                                        <label id="seleccion" for="checkbox14">Seleccione para mostrar campo de Retinoscopia.</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <textarea id="hall" rows="4" class="form-control no-resize"
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
                <button class="btn btn-primary" type="submit" id="" data-dismiss="modal"
                        onclick="updateConsulta()">Guardar
                </button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="" type="reset">Cancelar
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
