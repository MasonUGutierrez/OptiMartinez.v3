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
{!! Form::open(['method'=>'POST', 'action'=>'OpticaControllers\MarcoController@store', 'files'=>'true', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
{{-- @csrf
{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
    {{-- Row para los inputs generales --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Agregar</strong> Nuevo Marco</h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <input type="hidden" name="url" value="{{$previousURL}}">
                        {{-- Input para el codigo de marco --}}
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="cod_marco">Cod. Marco</label>
                                <input type="text" class="form-control @error('cod_marco') is-invalid @enderror" 
                                    id="cod_marco" name="cod_marco"
                                    placeholder="Ej: GU1791, RB6489, etc."
                                    value="{{old('cod_marco')}}">
                                @error('cod_marco')
                                    <span class="invalid-feedback">{{$message}}</span>   
                                @enderror

                            </div>
                        </div>
                        {{-- Input para la cantidad en existencia --}}
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="c_existencia">Cant. Existencia</label>
                                <input type="number" name="c_existencia" id="c_existencia" 
                                    class="form-control {{($errors->has('c_existencia'))?'is-invalid':''}}"
                                    min="0"
                                    placeholder="Ej: 5, 10, 15, etc."
                                    value="{{old('c_existencia')}}">
                                {!! $errors->first('c_existencia', '<span class="invalid-feedback">:message</span>') !!}
                            </div>
                        </div>
                        {{-- Input para el precio --}}
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="precio">Precio (C$)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="ti ti-wallet"></span>
                                        </div>
                                    </div>
                                    <input type="number" name="precio" id="precio" 
                                        class="form-control @error('precio') is-invalid @enderror"
                                        min="0"
                                        placeholder="Ej: C$ 100, C$ 150, C$ 200, etc."
                                        value="{{old('precio')}}">
                                    {!! $errors->first('precio', '<span class="invalid-feedback">:message</span>') !!}
                                </div>
                            </div>
                        </div>                        
                    </div>   
                    <div class="row clearfix">
                        {{-- Select para la marca --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <select name="id_marca" id="marca" class="form-control show-tick ms select2"
                                    data-placeholder="Seleccione la marca">
                                    <option></option>
                                    @foreach($marcas as $marca)
                                        <option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Select para los tipos de marcos --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="tipoMarcos">Tipo de Marco</label>
                                <select class="form-control show-tick ms"
                                    data-placeholder="Seleccione solo un tipo de cada categoria"
                                    name="id_tipos_marcos[]" id="id_tipo_marco"
                                    multiple>
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
                    </div>      
                </div>
            </div>
        </div>
    </div>
    {{-- Row para el dropify para subir imagen --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Subir</strong> foto</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="dir_foto" class="form-control dropify-es">
                        <input type="hidden" name="dir_foto" class="form-control {{($errors->has('dir_foto'))?'is-invalid':''}}">
                        {!! $errors->first('dir_foto', '<span class="invalid-feedback">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Row para los botones aceptar y cancelar --}}
    <div class="row clearfix">
        <div class="col-sm-4 offset-sm-4">
            <div class="form-group text-center">
                <input type="submit" class="btn btn-raised btn-primary waves-effect waves-light" value="Aceptar">
                <input type="button" class="btn btn-raised btn-danger waves-effect waves-light" value="Cancelar">
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection

@section('page-script')
{{-- Script para el Dropify--}}
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@endsection

@push('after-scripts')
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script>
    $(function(){
        $('#id_tipo_marco').select2({
            maximumSelectionSize: 2,
            formatSelectionTooBig: (maxSize) => {
                return 'Por favor, seleccione solo un tipo de cada categoria';
            }
        });
    });
</script>
@endpush