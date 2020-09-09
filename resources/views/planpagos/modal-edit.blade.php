<div class="modal modal2" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header">
                        <h2 class="title" id="titleEdit"><strong>Editar</strong> Plan de Pago</h2>
                    </div>
                </div>
                <label >Nombre Plan de Pago</label>
                <input type="hidden" id="idPlan">
                <input type="hidden" name="_method" value="PUT">
                <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                       id="plan_pago2" required name="plan_pago"
                       value="{{old("plan_pago")}}" placeholder="Plan..."/>
                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                <label for="">Descripcion del Plan de Pago</label>
                <div>
                        <textarea class="form-control no-resize {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                  id="descripcion2" name="descripcion" required cols="30"  placeholder="Descripcion..."
                                  rows="5">{{old("descripcion")}}</textarea>
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
