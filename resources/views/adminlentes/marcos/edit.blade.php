@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcos / Editar')

@section('page-style')
{{-- Estilos para el Dropify --}}
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">
{{-- Estilos para el select2 --}}
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}">

@endsection

@section('content')
{!! Form::model($marco, ['action'=>['OpticaControllers\MarcoController@update', $marco->id_marco], 'method'=>'PUT', 'files'=>'true', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}

{{-- Row para los inputs generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Editar</strong> Marco</h2>
            </div>
            <div class="body">
                {{-- Row para inputs --}}
                <div class="row clearfix">
                    <input type="hidden" name="url" value="{{$previousURL}}">
                    {{-- Input para el codigo de marco --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="cod_marco">Cod. Marco</label>
                            <input type="text" id="cod_marco"
                                name="cod_marco" class="form-control @error('cod_marco') is-invalid @enderror"
                                placeholder="Ej: GU1791, RB6489, etc."
                                value={{$marco->cod_marco}}>
                            @error('cod_marco')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Input para la cantidad en existencia --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="c_existencia">Cant. Existencia</label>
                            <input type="number" id="c_existencia"
                                name="c_existencia" class="form-control {{($errors->has('c_existencia')) ? 'is-invalid' : ''}}"
                                placeholder="Ej: 5, 10, 15, etc."
                                min="0"
                                value={{$marco->c_existencia}}>
                            {!! $errors->first('c_existencia','<span class="invalid-feedback">:message</span>') !!}
                        </div>
                    </div>
                    {{-- Input para el precio --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="precio">Precio (C$)</label>
                            <input type="number" id="precio"
                                name="precio" class="form-control @error('precio') is-invalid @enderror"
                                placeholder="Ej: C$ 100, C$ 150, C$ 200, etc."
                                min="0"
                                value={{$marco->precio}}>
                            {!! $errors->first('precio','<span class="invalid-feedback">:message</span>') !!}
                        </div>
                    </div>
                </div>
                {{-- Row para Selects --}}
                <div class="row clearfix">
                    {{-- Select para la marca --}}
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <select name="id_marca" id="marca" class="form-control show-tick ms select2"
                                data-placeholder="Selecciona la marca" value="{{$marco->id_marca}}">
                                <option></option>
                                @foreach($marcas as $marca)
                                    <option value="{{$marca->id_marca}}" {{($marca->id_marca == $marco->id_marca)?'selected':''}}>{{$marca->marca}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Select para los tipos de marcos --}}
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="tipoMarco">Tipo de Marco</label>
                            <select name="id_tipos_marcos[]" id="tipoMarco" class="form-control show-tick ms" multiple
                                data-placeholder="Seleccione solo un tipo de cada categoria">
                                <option></option>
                                <optgroup label="Estilo">
                                    @foreach($tiposMarcos as $tipoMarco)                                    
                                        @if($tipoMarco->tipo_marco != 'Marca' && $tipoMarco->tipo_marco != 'Economico')
                                            <option value="{{$tipoMarco->id_tipo_marco}}" {{(in_array($tipoMarco->id_tipo_marco, $marcoTipoM)) ? 'selected' : ''}}>{{$tipoMarco->tipo_marco}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>  
                                <optgroup label="Categoria">
                                    @foreach($tiposMarcos as $tipoMarco)
                                        @if($tipoMarco->tipo_marco == 'Marca' || $tipoMarco->tipo_marco == 'Economico')
                                            <option value="{{$tipoMarco->id_tipo_marco}}" {{(in_array($tipoMarco->id_tipo_marco, $marcoTipoM)) ? 'selected' : ''}}>{{$tipoMarco->tipo_marco}}</option>
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
{{-- Row para la subida de imagen --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Subir</strong> Foto</h2>
            </div>
            <div class="body">
                <div class="form-group">
                    <input type="file" class="form-control dropify-es" name="dir_foto" data-default-file="{{asset('storage/imagenes/marcos/'.$marco->dir_foto)}}">
                    <input type="hidden" class="form-control {{($errors->has('dir_foto'))?'is-invalid':''}}" name="dir_foto">
                    @error('dir_foto')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Row para los botones Aceptar y Cancelar --}}
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
{{-- Script para el dropify --}}
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
{{-- Script para el select2 --}}
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@endsection

@push('after-scripts')
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
<script>
    $(function(){
        $('#tipoMarco').select2({
            maximumSelectionSize: 2,
            formatSelectionTooBig: (size) => {
                return 'Por favor, seleccione solo un tipo de cada categoria';
            }
        });
        $('.select2').select2();

        var inputFile = $('[name=dir_foto]');
        console.log(inputFile.val());
    });
</script>
@endpush