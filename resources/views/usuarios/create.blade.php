@extends('layout.master')
@section('parentPageTitle', 'Admin. Usuarios')
@section('title', 'Nuevo Usuario')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <style>
        .input-group-text {padding: 0 .75rem;}
        /*label{font-size: 18px;}*/
        /* small{font-size: 10px;float: right;} */
    </style>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Registrar </strong>Nuevo Usuario</h2>
            </div>
            {!!Form::open(array('url'=>'usuarios','method'=>'POST','files'=>true,'autocomplete'=>'off')) !!}
            {{Form::token()}}

            <div class="body">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="form-group" >
                            <label for="">Codigo de Minsa</label>
                            <small class="text-muted">(*)</small>
                            <input type="text" class="form-control {{ $errors->has('cod_minsa') ? 'is-invalid' : '' }}" required name="cod_minsa" value="{{old("cod_minsa")}}" placeholder="Codigo de Minsa..." />
                            {!! $errors->first('cod_minsa', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <small class="text-muted">(*)</small>
                            <input type="text" name="nombre" required class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" value="{{old("nombre")}}" placeholder="Nombre..." />
                            {!! $errors->first('nombre', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <small class="text-muted">(*)</small>
                            <input type="text"  name="apellido" required class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" value="{{old("apellido")}}" placeholder="Apellido..." />
                            {!! $errors->first('apellido', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Cedula de indentidad</label>
                            <small class="text-muted">(*)</small>
                            <input type="text" name="cedula" required  class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}" value="{{old("cedula")}}" placeholder="Cedula..." />
                            {!! $errors->first('cedula', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" value="{{old("telefono")}}" placeholder="Telefono..." />
                            {!! $errors->first('telefono', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Correo Electronico</label>
                            <small class="text-muted">(*)</small>
                            <input type="email" name="correo" required value="{{old("correo")}}" class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" placeholder="Correo..." />
                            {!! $errors->first('correo', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label for="dir_foto">Foto de perfil</label>
                        <input type="file" name="dir_foto" value="{{old("dir_foto")}}" class="form-control" />
                    </div>--}}
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <small class="text-muted">(*)</small>
                            <input type="password" name="contraseña" value=""  class="form-control {{ $errors->has('contraseña') ? 'is-invalid' : '' }}" placeholder="Nueva Contraseña..." />
                            {!! $errors->first('contraseña', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Verificar Contraseña</label>
                            <small class="text-muted">(*)</small>
                            <input type="password" name="ccontraseña" value=""  class="form-control {{ $errors->has('ccontraseña') ? 'is-invalid' : '' }}" placeholder="Confirma Contraseña..." />
                            {!! $errors->first('ccontraseña', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea  class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"  rows="5" placeholder="Ingrese una descripción">{{old("descripcion")}}</textarea>
                            {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Asignación de Roles</label>
                            <small class="text-muted">(*)</small>
                            <select class="form-control show-tick ms select2" required name="id_roles[]"  multiple data-placeholder="Select">
                                @foreach($rol as $cat)
                                    <option value="{{$cat->id_rol}}">{{$cat->rol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <small class="text-muted">(*) Campos Obligatorios</small>
                    </div>
                    <div class="col-12">
                        <div class="form-group" style="text-align: center">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <a href=""><button class="btn btn-danger" onclick="history.back()" type="">Cancelar</button></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush
