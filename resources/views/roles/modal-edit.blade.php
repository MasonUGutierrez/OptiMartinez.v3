<div class="modal modal2" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="titleEdit">Editar Plan de Pago</h4>
                <h3 id="mensaje" hidden><strong>Guardado</strong></h3>
            </div>
            <div class="modal-body center">
                <label for="">Nombre Plan de Pago</label>
                <input type="hidden" id="idPlan">
                <input type="hidden" name="_method" value="PUT">
                <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                       id="plan_pago2" required name="plan_pago"
                       value="{{old("plan_pago")}}" placeholder="Plan..."/>
                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                <label for="">Descripcion del Plan de Pago</label>
                <div>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                  id="descripcion2" name="descripcion" required cols="30" placeholder="Descripcion..."
                                  rows="10">{{old("descripcion")}}</textarea>
                </div>
                {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
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
