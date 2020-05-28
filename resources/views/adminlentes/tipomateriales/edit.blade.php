@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales / Editar')

@section('page-style')
@endsection

@section('content')  
{!! Form::model($tipoMaterial, ['action'=>['OpticaControllers\TipoMaterialController@update',$tipoMaterial->id_tipo_material], 'method'=>'PUT', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Editar</strong> Material</h2>
            </div>
            <div class="row">
                {{-- Input para el material --}}
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="body">
                        <div class="form-group">
                            <label for="tipo_material">Material</label>
                            <input type="text" readonly class="form-control {{$errors->has('tipo_material') ? 'is-invalid' : ''}}" name="tipo_material" id="tipo_material" placeholder="Ej: Monofical, Bifocal, Transition, etc." value={{$tipoMaterial->tipo_material}}>
                            {!!($errors->first('tipo_material', '<span class="invalid-feedback">:message</span>'))!!}
                        </div>
                    </div>
                    <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" id="check" class="custom-control-input">
                        <label for="check" class="custom-control-label">
                            <small class="text-muted">Quiero cambiar el nombre</small>
                        </label>
                    </div>
                </div>
                {{-- Input para el precio --}}
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
                                <input type="number" min="0" class="form-control @error('precio') is-invalid @enderror" name="precio" id="precio" placeholder="Ej: C$ 100, C$ 150, C$ 200, etc." value={{$tipoMaterial->precio}}>
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
{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-sm-4 offset-sm-4">
        <div class="form-group text-center">
            <input type="submit" class="btn btn-raised btn-primary waves-effect waves-float waves-light" value="Aceptar">
            <input type="button" class="btn btn-raised btn-danger waves-effect waves-float waves-light" value="Cancelar">
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('page-script')    
<script>
    $(function(){
        'use strict'
        var material = $('#tipo_material'),
            initVal = material.val();

        $('#check').on('change', function(){
            if($(this).is(':checked'))
                material.removeAttr('readonly');
            else
            {
                material.prop('readonly', 'readonly');
                if(material.val() != initVal)
                    material.val(initVal);
            }
        });
    });
</script>
@endsection