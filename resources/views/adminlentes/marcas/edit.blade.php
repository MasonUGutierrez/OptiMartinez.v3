@extends('layout.master')

@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcas / Editar')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
<form action="{{URL::action('OpticaControllers\MarcaController@update', $marca->id_marca)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{-- HTML solo cuenta como los metodos HTTP GET y POST, los demas PUT, PATCH y DELETE son propios de laravel asi que para HTML no existe --}}
    {{-- Cuando se ocupa un metodo que implica dichos metodos HTTP extras es necesario enviar el verbo HTTP por un campo hidden --}}
    {{-- @method('verbHTTP') equivale a <input type="hidden" name="_method" value="verbHTTP" /> --}}
    @method('PUT')
    <input type="hidden" value="{{$marca->id_marca}}" name="id_marca">

    {{-- Row para los inputs generales --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Editar</strong> Marca</h2>
                </div>
                <div class="row">
                    {{-- Input para la marca --}}
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" value="{{$marca->marca}}" placeholder="Ej: Ray-Ban, Converse, Guess, etc."/>
                                @error('marca')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
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
                                        <span class="input-group-text">
                                            <i class="ti ti-wallet"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control {{$errors->has('precio') ? 'is-invalid' : ''}}" id="precio" name="precio" value="{{ $marca->precio }}" placeholder="Ej: C$ 100, C$ 150, C$ 200, etc.">
                                    {!! $errors->first('precio', '<span class="invalid-feedback">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Row para subir foto --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Subir</strong> Foto</h2>
                </div>
                <div class="body">
                    <input type="file" class="form-control dropify-es" name="img">
                    <input type="hidden" class="form-control @error('img') is-invalid @enderror" name="img" />
                    {!! $errors->first('img', '<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- Row para los botones aceptar y cancelar --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="mx-auto">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-raised waves-effect waves-light" value="Aceptar" />                                
                                <input type="button" class="btn btn-danger btn-raised waves-effect waves-light" value="Cancelar" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-script')
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
<script>
    function back(){
        history.back();
    }
    document.querySelector('[value="Cancelar"]').addEventListener('click', back);
</script>
@endsection