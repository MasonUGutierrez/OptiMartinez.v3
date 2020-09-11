<div class="modal modal2" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header mb-2">
                        <h2 class="title" id="titleEdit"><strong>Editar</strong> Plan de Pago</h2>
                    </div>
                    <input type="hidden" id="idPlan">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row clearfix mb-3">
                        <div class="col">
                            <label for="plan_pago2">Nombre del Plan de Pago</label>
                            <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                                   id="plan_pago2" required name="plan_pago"
                                   value="{{old("plan_pago")}}" placeholder="Nombre Plan..."/>
                            {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <label for="descripcion2">Descripcion del Plan de Pago</label>
                            <textarea class="form-control no-resize {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                        id="descripcion2" name="descripcion" required cols="30"  placeholder="Descripcion..."
                                        rows="5">{{old("descripcion")}}</textarea>
                            {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
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
