<div class="modal " id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header mb-2">
                        <h2 class="title" id="titleNew"><strong>Nueva</strong> Orden de Lentes</h2>
                    </div>
                    <div class="row clearfix mb-3">
                        <div class="col-md-6">
                            <label class="" ><strong>Plan de Pago</strong></label>
                            <select class=" form-control show-tick ms select2 center-block border rounded" id="getPlanPagos" required data-placeholder="-- Plan de Pago --">
                                <option value=""> </option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label ><strong>Monto Total Estimado</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="ti ti-wallet"></span>
                                    </div>
                                </div>
                            <input type="number" id="montoTotalEstimado" class="form-control show-tick ms center-block border rounded" placeholder="Ej: C$ 100, C$ 150, etc.">
                            </div>
                            </div>
                    </div>
                    <div class="row clearfix"   id="divCuota">
                        <div id="idCuota" class="col-md-12" >
                            <label ><strong>Cuota Inicial</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="ti ti-wallet"></span>
                                    </div>
                                </div>
                                <input id="cuotaInicial" type="number" class="form-control show-tick ms center-block border rounded" placeholder="Ej: C$ 100, C$ 150, C$ 200, etc.">
                            </div>
                        </div>
                        {{--<div id="" class="col-md-6">
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button class="btn btn-primary" type="submit" id="guardar"  onclick="saveData()" >Guardar</button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" type="reset">Cancelar</button>
                </a>--}}
                <span class="btn btn-primary" onclick="saveOrden()">Guardar</span>
            </div>
        </div>
    </div>
</div>
