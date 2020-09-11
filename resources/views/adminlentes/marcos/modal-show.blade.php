<div class="modal" tabindex="-1" role="dialog" id="showMarco">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="header mb-3">
                        <h2><strong>Detalles </strong>del marco</h2>
                    </div>
                    <div class="row clearfix">
                        {{-- Col para inputs cod_marco, precio y c_existencia --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="cod_marco">Cod. Marco</label>
                                <input type="text" id="cod_marco" class="form-control" disabled>
                                <label for="precio">Precio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="ti ti-wallet"></i>
                                        </div>
                                        <input type="number" id="precio" class="form-control" disabled>
                                    </div>
                                </div>
                                <label for="c_existencia">Cant. Existencia</label>
                                <input type="number" id="c_existencia" class="form-control" disabled>
                            </div>
                        </div>
                        {{-- Col para la imagen --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <p><label for="dir_foto">Imagen</label></p>
                                <img src="#" id="dir_foto" alt="imagen del marco seleccionado" class="rounded img-raised">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tiposMarcos">Tipos de Marcos</label>
                                <select id="tiposMarcos" disabled class="form-control show-tick ms select2" multiple >                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        var id_marco;
        $('.btnShowMarco').on("click", function(event){
            //event.preventDefault(); // previniendo que se muestra el modal mientras se rellenan los campos
            
            id_marco = $(this).data('idmarco');
            // $('#showMarco').modal('show');
            
        })
        $('#showMarco').on('shown.bs.modal', function(event){  
            console.log(event);          
            var select = $('#tiposMarcos');
            $.ajax(`/admin-lentes/marcos/${id_marco})`,{
                type:'GET',
                dataType:'json',
                success:function(datas, statusText, jqXHR){
                    select.find('option').remove();

                    //Llenando inputs
                    $('#cod_marco').val(datas.marco.cod_marco);
                    $('#precio').val(datas.marco.precio);
                    $('#c_existencia').val(datas.marco.c_existencia);
    
                    //Llenando img
                    $('#dir_foto').prop('src', '/storage/imagenes/marcos/'+datas.marco.dir_foto);
    
                    //Llenando select
                    $(datas.tiposMarco).each(function(i,v){ // indice y valor
                        select.append('<option value="'+ v.id_tipo_marco +'" selected>'+ v.tipo_marco +'</option>')
                    })
                    // Truco escencial porque se ocupa select2, se tiene que hacer el trigger de forma manual
                    // /* Nota: Trigger es un disparador de eventos de forma manual, en este caso se 
                    //             pidio que disparara el evento change 
                    // */
                    select.trigger('change'); 
                },
                error:function(jqXHR, statusText, error){
                    console.log(jqXHR);
                }
            });
        });
    });
</script>