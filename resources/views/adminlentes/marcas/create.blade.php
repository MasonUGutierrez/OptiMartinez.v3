@extends('layout.master')

@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcas / Agregar')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">
@endsection
    
@section('content')
{{-- route('routeName') -> genera la url de la ruta que se manda como parametro --}}
{{-- Atributo enctype="multipart/form-data" == 'files'=>true de laravel collective --}}

<form action="{{ route('marcas.store') }}" method="post" enctype="multipart/form-data">
{{-- <form action="admin-lentes/marcas" method="POST" files="true"> --}}
{{-- <form action="{{ URL::action('OpticaControllers\MarcaController@store') }}" method="POST" files="true"> --}}

    @csrf {{--Equivale a: <input type="hidden" name="_token" value="{{ csrf_token() }}"> o {{ csrf_field() }} , tambien a: {{ Form::token() }} --}}
    {{-- Row para los input generales --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Agregar</strong> Nueva Marca</h2>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="marca">Marca </label>
                                <input type="text" class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" value="{{old('marca')}}" placeholder="Ej.: Ray-Ban, Converse, Guess, etc.">
                                @error('marca')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                        
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="body">
                            <div class="form-group">
                                <label for="precio">Precio Base (C$) </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ti ti-wallet"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{old('precio')}}" placeholder="Ej.: C$ 100, C$ 150, C$ 200, etc.">
                                    @error('precio')
                                        <span class="invalid-feedback">{{ $message }}<span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Row para subir la foto --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Subir</strong> Foto</h2>
                </div>
                <div class="body"> 
                    <input type="file" class="form-control dropify-es" name="img">
                    {{-- Input hidden para que al menos se pueda mostrar el mensaje del error en el campo img en el <span> --}}
                    <input type="hidden" class="form-control @error('img') is-invalid @enderror ">
                    @error('img')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror                     
                </div>                
            </div>
        </div>
    </div>
    {{-- Row para los botones aceptar y cancelar --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="row clearfix">
                    <div class="mx-auto">
                        <div class="form-group">
                            <input type="submit" class="btn btn-raised btn-primary waves-float waves-effect waves-light" value="Aceptar">
                            <input type="button" class="btn btn-raised btn-danger waves-float waves-effect waves-light" value="Cancelar">
                            <a href="javascript:window.history.back();" class="btn btn-raised btn-danger waves-effect waves-light">Cancelar</a>
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
        window.history.back();
    }
    
    document.querySelector("[value='Cancelar']").addEventListener('click', back);
</script>
@endsection