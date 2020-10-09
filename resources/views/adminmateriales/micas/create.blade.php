@extends('layout.master')
@section('parentPageTitle', 'Admin. Materiales')
@section('title', 'Nueva Mica')

@section('page-style')
@endsection

@section('content') 
{!! Form::open(['action'=>'OpticaControllers\MicaController@store', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Agregar</strong> Nueva Mica</h2>
            </div>
            <div class="row">
                {{-- Input para el tipo de mica --}}
                <div class="col-lg-12">
                    <div class="body">
                        <div class="form-group">
                            <label for="mica">Mica</label>
                            <input type="text" class="form-control {{$errors->has('mica') ? 'is-invalid' : ''}}" name="mica" id="mica" placeholder="Ej: Plastico, Policarbonato, Vidrio, etc." value={{old('mica')}}>
                            {!!($errors->first('mica', '<span class="invalid-feedback">:message</span>'))!!}
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
            <input type="submit" class="btn btn-raised btn-primary waves-effect waves-float waves-light" value="Aceptar">
            <input type="button" class="btn btn-raised btn-danger waves-effect waves-float waves-light" value="Cancelar">
        </div>
    </div>
</div>
{!! Form::close() !!}  
@endsection

@section('page-script')    
@endsection

@push('aftet-scripts')
@endpush