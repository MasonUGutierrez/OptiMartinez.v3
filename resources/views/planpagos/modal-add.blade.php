<div class="modal " id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header mb-2">
                        <h2 class="title" id="titleNew"><strong>Registrar</strong> Nuevo Plan de Pago</h2>
                    </div>
                    <div class="row clearfix mb-3">
                        <div class="col">
                            <label for="plan_pago">Nombre del Plan de Pago</label>
                            <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                                   id="plan_pago" required name="plan_pago"
                                   value="{{old("plan_pago")}}" placeholder="Plan..."/>
                            {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <label for="descripcion">Descripcion del Plan de Pago</label>
                            <textarea class="form-control no-resize {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                        id="descripcion" name="descripcion" required cols="20" placeholder="Descripcion..."
                                        rows="5">{{old("descripcion")}}</textarea>
                            {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                </div>
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
