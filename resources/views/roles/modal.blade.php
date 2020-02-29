<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-asignar-{{$cat->id_rol}}">

    {!!Form::open(array('url'=>'roles',$cat->id_rol,'method'=>'POST','autocomplete'=>'off')) !!}
    {{Form::token()}}
    <div class="modal-dialog  col-sm-10">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title">Asignar Rol "{{$cat->rol}}"</h4>
            </div>
            <input id="" name="id_rol" type="hidden" value="{{$cat->id_rol}}">
            <div class="modal-body">
                <div class="body">
                    <div class="col-sm-10">
                        <p><b>Lista de Usuarios</b></p>
                        <select name="id_usuario" class="form-control show-tick ms search-select"  data-placeholder="Select">
                                <option class="" disabled selected value> -- Selecciona un Usuario -- </option>
                            @foreach($usuario as $cate)
                                <option value="{{$cate->id_usuario}}">{{$cate->nombre." ".$cate->apellido}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>
