@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <style>
        .input-group-text {
            padding: 0 .75rem;
        }
    </style>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Asignar Rol: {{$rol->rol}}</strong></h3>
                </div>
                {!!Form::open(array('url'=>'roles',$rol->id_rol,'method'=>'POST','autocomplete'=>'off')) !!}
                {{Form::token()}}
                <div class="body">
                    <div class="col-sm-10">
                        <input id="" name="id_rol" type="hidden" value="{{$rol->id_rol}}">
                        <p><b>Lista de Usuarios</b></p>
                        <select name="id_usuario[]"  class="form-control show-tick ms select2" required multiple data-placeholder="Select">
                            <option class="" disabled selected value> -- Selecciona un Usuario -- </option>
                            @foreach($usuario as $cate)
                                <option value="{{$cate->id_usuario}}">{{$cate->nombre." ".$cate->apellido}} </option>
                            @endforeach
                        </select>
                        <div class="" style="text-align: center">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <a href="/roles"><button class="btn btn-danger" type="">Cancelar</button></a>
                        </div>
                    </div>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop
