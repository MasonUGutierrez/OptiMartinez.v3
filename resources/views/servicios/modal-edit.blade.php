<div class="modal servicioAsignar" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title">Editar Servicio</h4>
            </div>
            <div class="modal-body center">
                <label for="">Nombre de Servicio</label>
                <input type="hidden" id="idServicio">
                <input type="hidden" name="_method" value="PUT">
                <input type="text" class="form-control  {{ $errors->has('servicio') ? 'is-invalid' : '' }}"
                       id="servicio" required name="plan_pago"
                       value="{{old("servicio")}}" placeholder="Plan..."/>
                {!! $errors->first('servicio', '<small class="invalid-feedback">:message</small>') !!}
                <label for="">Precio del Servicio</label>
                <div>
                    <input type="text" id="precio" name="precio" class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}"   />
                    {!! $errors->first('precio', '<small class="invalid-feedback">:message</small>') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar" data-dismiss="modal" onclick="updateData()" >Guardar</button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" type="reset">Cancelar</button>
                </a>
            </div>
        </div>
    </div>
</div>
