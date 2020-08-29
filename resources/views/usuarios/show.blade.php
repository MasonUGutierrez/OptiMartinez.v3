@extends('layout.master')
@section('parentPageTitle', 'Admin. Usuarios')
@section('title', 'Detalle Usuario')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}"/>
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
                    <h2><strong>Detalle </strong>de Usuario: {{$usuario->nombre}} <a
                            href="{{URL::action('OpticaControllers\UsuarioController@edit',$usuario ->id_usuario)}}">
                            <button class="btn btn-success">Editar Registro</button>
                        </a></h2>
                </div>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="body">
                    <div class="row clearfix">
                        <div class="form-group col-12">
                            <label for="">Codigo de Minsa</label>
                            <input type="text" class="form-control" disabled name="cod_minsa"
                                   value="{{$usuario->cod_minsa}}" placeholder="Codigo de Minsa..."/>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" class="form-control" disabled
                                   value="{{$usuario->nombre}}" placeholder="Nombre..."/>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Apellido</label>
                            <input type="text" name="apellido" class="form-control" disabled
                                   value="{{$usuario->apellido}}" placeholder="Apellido..."/>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Cedula de indentidad</label>
                            <input type="text" name="cedula" class="form-control" disabled
                                   value="{{$usuario->cedula}}" placeholder="Cedula..."/>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" class="form-control" disabled
                                   value="{{$usuario->telefono}}" placeholder="Telefono..."/>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Correo Electronico</label>
                            <input type="email" name="correo" class="form-control" disabled
                                   value="{{$usuario->correo}}" placeholder="Correo..."/>
                        </div>
                        <div class="form-group col-10">
                            <label><b>Foto de perfil</b></label>
                            <div class="form-group">
                                <img src="/imagenes/usuarios/{{$usuario->dir_foto}}" class="img-thumbnail"
                                     width="200" alt="No cuenta con una foto de perfil">
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="contraseña" class="form-control" disabled value="{{$usuario->contraseña}}" placeholder="Nueva Contraseña..." />
                        </div>--}}
                        <div class="form-group col-12">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="5" disabled
                                      placeholder="Ingrese una descripción">{{$usuario->descripcion}}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <p><b>Roles Asignados</b></p>
                            <select class="form-control show-tick ms select2" disabled required name="id_roles[]"
                                    multiple data-placeholder="{{--{{$rol->rol}}--}}">
                                @foreach($rol as $cat)
                                    <option
                                        value="{{$cat->id_rol}}" {{(in_array($cat->id_rol,$valores)) ? 'selected' : ''}}>{{$cat->rol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
@endpush
