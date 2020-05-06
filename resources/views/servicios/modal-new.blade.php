<div class="modal servicioadd" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body center">
                <div class="card">
                    <div class="header">
                        <h2 class="pb-2"><strong>Nuevo</strong> Servicio</h2>
                    </div>
                    <label for="">Nombre de Servicio</label>
                    <input type="hidden" id="idServicio">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="text" class="form-control  {{ $errors->has('servicio') ? 'is-invalid' : '' }}"
                           id="servicio2" required name="plan_pago"
                           value="{{old("servicio")}}" placeholder="Plan..."/>
                    {!! $errors->first('servicio', '<small class="invalid-feedback">:message</small>') !!}
                    <label for="">Precio del Servicio</label>
                    <div>
                        <input type="text" id="precio2" name="precio" class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}" placeholder="Precio..."   />
                        {!! $errors->first('precio', '<small class="invalid-feedback">:message</small>') !!}
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
