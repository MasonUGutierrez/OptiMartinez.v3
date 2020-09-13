<div class="modal servicioadd" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header">
                        <h2 class="pb-2"><strong>Registrar</strong> Nuevo Servicio</h2>
                    </div>
                    <input type="hidden" id="idServicio">
                    <div class="row clearfix mb-3">
                        <div class="col">
                            <label for="servicio2">Nombre del Servicio</label>
                            {{--<input type="hidden" name="_method" value="PUT">--}}
                            <input type="text" class="form-control  {{ $errors->has('servicio') ? 'is-invalid' : '' }}"
                                   id="servicio2" required name="plan_pago"
                                   value="{{old("servicio")}}" placeholder="Plan..."/>
                                   {!! $errors->first('servicio', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <label for="precio2">Precio del Servicio</label>
                            <input type="number" id="precio2" name="precio" class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}" placeholder="Precio..."   />
                            {!! $errors->first('precio', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="guardar" data-dismiss="modal" onclick="saveData()" >Guardar</button>
                <a href="">
                    <button class="btn btn-danger" data-dismiss="modal" type="reset">Cancelar</button>
                </a>
            </div>
        </div>
    </div>
</div>
