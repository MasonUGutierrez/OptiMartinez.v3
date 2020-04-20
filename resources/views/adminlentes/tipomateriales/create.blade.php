@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales / Agregar')

@section('page-style')
@endsection

@section('content') 
{!! Form::open(['action'=>'OpticaControllers\TipoMaterialController@store', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Agregar</strong> Nuevo Material</h2>
            </div>
            <div class="row">
                {{-- Input para el material --}}
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="body">
                        <div class="form-group">
                            <label for="tipo_material">Material</label>
                            <input type="text" class="form-control {{$errors->has('tipo_material') ? 'is-invalid' : ''}}" name="tipo_material" id="tipo_material" placeholder="Ej: Monofical, Bifocal, Transition, etc." value={{old('precio')}}>
                            {!!($errors->first('tipo_material', '<span class="invalid-feedback">:message</span>'))!!}
                        </div>
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
                                <input type="number" min="0" class="form-control @error('precio') is-invalid @enderror" name="precio" id="precio" placeholder="Ej: C$ 100, C$ 200, C$ 300, etc." value={{old('precio')}}>
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
            <input type="submit" class="btn btn-raised btn-primary waves-effect waves-float waves-light" value="Aceptar">
            <input type="button" class="btn btn-raised btn-danger waves-effect waves-float waves-light" value="Cancelar">
        </div>
    </div>
</div>
{!! Form::close() !!}  
@endsection

@section('page-script')    
@endsection