@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Tipos de Lentes / Editar')

@section('content')
{!! Form::model($tipoLente, ['action'=>['OpticaControllers\TipoLenteController@update', $tipoLente->id_tipo_lente], 'method'=>'PUT']) !!}
{!! Form::token() !!}
    {{-- Row para los inputs --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Editar</strong> Tipo de Lente</h2>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="tipo_lente">Tipo de Lente</label>
                                <input type="text" readonly class="form-control {{$errors->has('tipo_lente')?'is-invalid':''}}" 
                                        name="tipo_lente" id="tipo_lente" 
                                        placeholder="Ej.: Monofocal, Bifocal, Invisile etc." 
                                        value="{{$tipoLente->tipo_lente}}">
                                {!! $errors->first('tipo_lente', '<span class="invalid-feedback">:message</span>') !!}
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="check">
                                    <label for="check" class="custom-control-label"><small class="text-muted">Quiero cambiar el nombre</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="precio">Precio Base (C$)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="ti ti-wallet"></span>
                                        </div>
                                    </div>
                                    <input type="number" min="0" max="99999" class="form-control @error('precio') is-invalid @enderror" 
                                            name="precio" id="precio" 
                                            placeholder="Ej.: C$ 100, C$ 150, C$ 200, etc."
                                            value="{{$tipoLente->precio}}">
                                    @error('precio')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    {{-- Row para los botones --}}
    <div class="row clearfix">
        <div class="col-sm-4 offset-sm-4">
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary btn-raised waves-effect waves-light" value="Aceptar">
                <input type="button" class="btn btn-danger btn-raised waves-effect waves-light" value="Cancelar">
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection

@section('page-script')
<script>
    $(function(){
        // Variable para obtener el valor inicial del input
        var initVal = $('#tipo_lente').val();

        // Callback al evento change del input type=checkbox para habilitar el campo tipo_lente y dejar que se edite
        $('#check').on('change', function(){
            if($(this).is(':checked'))
                $('#tipo_lente').removeAttr('readonly'); // Se habilita el input quitando el atributo readonly
            else{
                $('#tipo_lente').prop('readonly', 'readonly'); // Se deshabilita el input seteando el atributo readonly
                // Se comprueba si se cambio el valor
                if ($('#tipo_lente').val() != initVal) 
                    $('#tipo_lente').val(initVal) // Regresa el valor al valor inicial si deshabilito el input antes de guardar
            }
        });
    });
</script>
@endsection