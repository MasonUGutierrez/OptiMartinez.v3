@extends('layout.master')
@section('parentPageTitle', 'Admin. Materiales')
@section('title', 'Editar Mica')

@section('page-style')
@endsection

@section('content')  
{!! Form::model($mica, ['action'=>['OpticaControllers\MicaController@update',$mica->id_mica], 'method'=>'PUT', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Editar</strong> Mica</h2>
            </div>
            <div class="row">
                {{-- Input para el tipo de Mica --}}
                <div class="col-lg-12">
                    <div class="body">
                        <div class="form-group">
                            <label for="mica">Mica</label>
                            <input type="text" readonly class="form-control {{$errors->has('mica') ? 'is-invalid' : ''}}" name="mica" id="mica" placeholder="Ej: Plastico, Policarbonato, Vidrio, etc." value={{$mica->mica}}>
                            {!!($errors->first('mica', '<span class="invalid-feedback">:message</span>'))!!}
                        </div>
                    </div>
                    <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" id="check" class="custom-control-input">
                        <label for="check" class="custom-control-label">
                            <small class="text-muted">Quiero cambiar el nombre</small>
                        </label>
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
@endsection

@push('after-scripts')
<script>
    $(function(){
        'use strict'
        var mica = $('#mica'),
            initVal = mica.val();

        $('#check').on('change', function(){
            if($(this).is(':checked'))
                mica.removeAttr('readonly');
            else
            {
                mica.prop('readonly', true);
                if(mica.val() != initVal)
                    mica.val(initVal);
            }
        });
    });
</script>
@endpush