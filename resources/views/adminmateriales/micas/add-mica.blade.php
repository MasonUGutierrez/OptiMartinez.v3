<div class="modal fade" id="AddMaterialMica" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="materialMicaForm" method="POST">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header mb-2">
                                    <h2><strong>Agregar</strong> Nuevo Material de Mica</h2>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="material_mica">Material Mica</label>
                                            <input type="text" class="form-control" name="material_mica" id="material_mica" placeholder="Ej.: Plastico, Policarbonato, etc.">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="custom-control custom-checkbox custom-control-inline text-muted">
                                            <input type="checkbox" id="presentaciones" name="presentaciones" class="custom-control-input">
                                            <label for="presentaciones" class="custom-control-label">Agregar presentación</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-lg-12" id="presContainer">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Presentaciones</strong></h2>
                                </div>
                            </div>    
                        </div>                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>