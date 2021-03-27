<div class="modal fade" id="AddMaterialMica" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="materialMicaForm" method="POST">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="col-lg-12">
                                <div class="header mb-2">
                                    <h2><strong>Agregar</strong> Nuevo Material</h2>
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
                            <div class="col-lg-12" id="presContainer">
                                <div class="header">
                                    <h2><strong>Presentaciones</strong>
                                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Presentación">
                                            <a href="#" class="btn btn-sm btn-success waves-effect waves-light waves-float" id="addPres">
                                                <i class="zmdi zmdi-plus"></i>
                                            </a>
                                        </span>
                                    </h2>
                                </div>
                                <div class="row clearfix newPres">
                                    {{-- Select para indicar la marca --}}
                                    <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control show-tick select2 marcas" name="id_marca"
                                            data-placeholder="Seleccione la marca">
                                                <option></option>
                                            </select>
                                            {{-- <label for="">Presentación</label> --}}
                                            {{-- <input type="text" class="form-control marcas" placeholder="Seleccione la Marca"> --}}
                                        </div>
                                    </div>
                                    {{-- Input para indicar del precio del material por la marca --}}
                                    <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                            {{-- <label for="">Precio</label> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="ti ti-wallet"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Boton para eliminar la marca que se va registrar --}}
                                    <div class="col-md-2 col-sm-12">
                                        <button class="btn btn-danger btn-block waves-effect waves-light waves-float mt-0" style="color:#fff">
                                            <i class="zmdi zmdi-block"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>