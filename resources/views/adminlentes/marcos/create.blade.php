@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcos / Agregar')

@section('page-style')

{{-- Estilos para el Dropify --}}
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="cod_marco">Cod. Marco</label>
                            <input type="text" class="form-control" 
                                   id="cod_marco" name="cod_marco"
                                   placeholder="Ej: GU1791, RB6489, Converse Q102, etc."
                                   value="{{old('cod_marco')}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <select name="marca" id="marca" class="selectpicker" 
                                multiple 
                                data-live-search="true"
                                data-size='5'>
                                @foreach($marcas as $marca)
                                    <option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for=""></label>
                        </div>
                    </div>
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

<script>

</script>
@endsection