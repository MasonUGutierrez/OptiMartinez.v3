<div class="modal " id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="titleNew">Nuevo Plan de Pago</h4>
                <h3 id="mensaje" hidden><strong>Guardado</strong></h3>
            </div>
            <div class="modal-body center">
                <label for="">Nombre Plan de Pago</label>
                <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                       id="plan_pago" required name="plan_pago"
                       value="{{old("plan_pago")}}" placeholder="Plan..."/>
                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                <label for="">Descripcion del Plan de Pago</label>
                <div>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                  id="descripcion" name="descripcion" required cols="30" placeholder="Descripcion..."
                                  rows="10">{{old("descripcion")}}</textarea>
                </div>
                {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar"  onclick="saveData()" >Guardar</button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" type="reset">Cancelar</button>
                </a>
            </div>
        </div>
    </div>
</div>
