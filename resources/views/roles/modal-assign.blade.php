<div class="modal assign-modal" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title">Detalle de Rol</h4>
            </div>
            <div class="modal-body center">
                <div class="col-sm-10">
                    {{--<input id="" name="id_rol" type="hidden" value="{{$rol->id_rol}}">--}}
                    <p><b>Lista de Usuarios</b></p>
                    <select name="id_usuario[]" id="select" class="form-control show-tick ms select2" required multiple data-placeholder="Select">
                        <option class="" disabled selected value> -- Selecciona un Usuario -- </option>

                    </select>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="/roles"><button class="btn btn-danger" data-dismiss="modal" type="">Cancelar</button></a>
            </div>
        </div>
    </div>
</div>
