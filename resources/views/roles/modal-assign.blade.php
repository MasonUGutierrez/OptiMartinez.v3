<div class="modal assign-modal" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header"><h2><strong>Asignar </strong>Rol a Usuario</h2></div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            {{--<input id="" name="id_rol" type="hidden" value="{{$rol->id_rol}}">--}}
                            <p><b>Lista de Usuarios</b></p>
                            <select name="id_usuario[]" id="select" class="form-control show-tick ms select2" required multiple data-placeholder="Seleccione un Usuario">
                                <option class="" disabled selected value> -- Selecciona un Usuario -- </option>
                            </select>

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" onclick="saveAssign()" type="submit">Guardar</button>
                <a href="#"><button class="btn btn-danger" data-dismiss="modal" onclick="clearData()" type="">Cancelar</button></a>
            </div>
        </div>
    </div>
</div>
