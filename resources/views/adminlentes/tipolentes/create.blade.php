@extends('layout.master')

@section('parentPageTitle', 'Admin. lentes')
@section('title', 'Tipos de Lentes / Agregar')

@section('page-style')
@endsection

@section('content')
{!! Form::open(['action'=>'OpticaControllers\TipoLenteController@store', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
    {{-- Row para los inputs --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Agregar</strong> Nuevo Tipo de Lente</h2>
                </div>            
                <div class="row">
                    {{-- Div para el campo tipo de lente --}}
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="tipo_lente">Tipo de Lente</label>
                                <input type="text" class="form-control {{$errors->has('tipo_lente')?'is-invalid':''}}" 
                                        name="tipo_lente" id="tipo_lente" 
                                        placeholder="Ej: Monofocal, Bifocal, Invisile etc."
                                        value="{{old('tipo_lente')}}">
                                {!!$errors->first('tipo_lente','<span class="invalid-feedback">:message</span>')!!}
                            </div>
                        </div>
                    </div>
                    {{-- Div para el campo precio --}}
                    <div class="col-lg-5 col-md-6 col-sm-12">
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
                                            placeholder="Ej: C$ 100, C$ 150, C$ 200, etc."
                                            value="{{old('precio')}}">
                                    @error('precio')
                                        <span class="invalid-feedback">{{ $message }}</span>
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
            {{-- Div para los botones --}}
        <div class="col-sm-4 offset-sm-4">
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary btn-raised waves-effect waves-float waves-light" value="Aceptar">
                <input type="button" class="btn btn-danger btn-raised waves-effect waves-float waves-light" value="Cancelar">
            </div>
        </div> 
    </div>
{!! Form::close() !!}
@endsection

@section('page-script')
@endsection