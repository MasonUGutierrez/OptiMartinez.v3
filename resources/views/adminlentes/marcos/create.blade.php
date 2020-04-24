@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcos / Agregar')

@section('page-style')

{{-- Estilos para el Dropify --}}
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Agregar</strong> Nuevo Marco</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-7 col-sm-12">
                        <div class="form-group">
                            <label for="cod_marco">Cod. Marco</label>
                            <input type="text" class="form-control" 
                                   id="cod_marco" name="cod_marco"
                                   placeholder="Ej: GU1791, RB6489, Converse Q102, etc."
                                   value="{{old('cod_marco')}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-sm-12">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <select name="id_marca" id="marca" class="form-control show-tick ms select2"
                                data-placeholder="Selecciona la marca">
                                <option></option>
                                @foreach($marcas as $marca)
                                    <option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>   
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-7">
                        <div class="form-group">
                            <label for="tipoMarcos">Tipo de Marco</label>
                            <select class="form-control show-tick ms select2"
                                data-placeholder="Selecciona el tipo de marco"
                                name="id_tipo_marco[]" id="id_tipo_marco"
                                multiple>
                                <option></option>
                                <optgroup label="Estilo">
                                    @foreach($tiposMarcos as $tMarco)
                                        @if($tMarco->tipo_marco != "Marca" && $tMarco->tipo_marco != "Economico")
                                            <option value="{{$tMarco->id_tipo_marco}}">{{$tMarco->tipo_marco}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Categoria">
                                    @foreach($tiposMarcos as $tMarco)
                                        @if($tMarco->tipo_marco == "Marca" || $tMarco->tipo_marco == "Economico")
                                            <option value="{{$tMarco->id_tipo_marco}}">{{$tMarco->tipo_marco}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="c_existencia">Cant. Existencia</label>
                            <input type="number" name="c_existencia" id="c_existencia" 
                                class="form-control"
                                placeholder=""
                                value="{{old('c_existencia')}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="precio">Precio (C$)</label>
                            <input type="number" name="precio" id="precio" 
                                class="form-control"
                                placeholder=""
                                value="{{old('precio')}}">
                        </div>
                    </div>
                </div> 
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6">
                        <p> <b>Multiple Select</b> </p>
                        <select class="form-control show-tick ms select2" multiple data-placeholder="Select">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Subir</strong> foto</h2>
            </div>
            <div class="body">
                <div class="form-group">
                    <input type="file" name="dir_foto" 
                    class="dropify-es">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
{{-- Script para el Dropify--}}
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@endsection

@push('after-scripts')
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush