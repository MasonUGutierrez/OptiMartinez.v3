@extends('layout.master')
@section('parentPageTitle', 'Admin. Usuarios')
@section('title', 'Editar Usuario')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <style>
        .input-group-text {
            padding: 0 .75rem;
        }

        label {
          /*  font-size: 18px;*/
        }
    </style>
@stop
@section('addButton')
    <span class="d-inline-block float-right" tabindex="0" data-toggle="tooltip" data-placement="left" title="Regresar">
    <button class="btn btn-primary btn-round btn-icon waves-effect waves-light" onclick="history.back()"><i class="zmdi zmdi-arrow-left"></i></button>
</span>
@endsection
@section('content')
{!!Form::model($usuario,['method'=>'PATCH','files'=>true,'route'=>['usuarios.update',$usuario->id_usuario]])!!}
{!! Form::token() !!}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Detalle </strong> Usuario
                    <span  class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar" data-original-title="Editar">
                            <a id="botonEditar" style="color: white" class="btn btn-sm btn-success btn-raised waves-effect waves-blue waves-float" onclick="editUsuario()">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                        </span>
                    <span  class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cancelar Edicion" data-original-title="Editar">
                            <a style="color: white"  id="botonCancelar" hidden class="btn btn-sm btn-danger btn-raised waves-effect waves-blue waves-float" onclick="cancelUsuario()">
                                <i class="zmdi zmdi-tag-close"></i>
                            </a>
                        </span>
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Codigo de Minsa</label>
                            <input id="cod_minsa" type="text" disabled
                                   class="form-control {{ $errors->has('cod_minsa') ? 'is-invalid' : '' }}"
                                   name="cod_minsa" value="{{$usuario->cod_minsa}}"
                                   placeholder="Codigo de Minsa..."/>
                            {!! $errors->first('cod_minsa', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group ">
                            <label for="">Nombre</label>
                            <input id="nombreUsuario" type="text" disabled name="nombre"
                                   class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->nombre}}" placeholder="Nombre..."/>
                            {!! $errors->first('nombre', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input id="apellidoUsuario" type="text" disabled name="apellido"
                                   class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->apellido}}" placeholder="Apellido..."/>
                            {!! $errors->first('apellido', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Cedula de indentidad</label>
                            <input id="cedulaUsuario" type="text" disabled name="cedula"
                                   class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->cedula}}" placeholder="Cedula..."/>
                            {!! $errors->first('cedula', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input id="telefonoUsuario" type="number" disabled name="telefono"
                                   class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->telefono}}" placeholder="Telefono..."/>
                            {!! $errors->first('telefono', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Correo Electronico</label>
                            <input id="emailUsuario" type="email" disabled name="correo"
                                   class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->correo}}" placeholder="Correo..."/>
                            {!! $errors->first('correo', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="dir_foto">Foto de perfil</label>
                            <div class="form-group">
                                <img src="/imagenes/usuarios/{{$usuario->dir_foto}}" width="300"
                                     class="img-thumbnail"
                                     alt="No cuenta con una foto de perfil">
                            </div>
                        </div>
                    </div>
                    <div hidden id="pass" class="col-md-6 col-sm-12">
                        <div class="form-group ">
                            <label for="">Contraseña</label>
                            <input type="password"  name="contraseña" class="form-control"
                                   {{ $errors->has('contraseña') ? 'is-invalid' : '' }} value="{{$usuario->contraseña}}"
                                   placeholder="Nueva Contraseña..."/>
                            {!! $errors->first('contraseña', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div hidden id="passReco" class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Verificar Contraseña</label>
                            <input type="password"  name="ccontraseña"
                                   class="form-control {{ $errors->has('ccontraseña') ? 'is-invalid' : '' }}"
                                   value="{{$usuario->contraseña}}" placeholder="Confirma Contraseña..."/>
                            {!! $errors->first('ccontraseña', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea id="descripcionUsuario" disabled class="form-control no-resize {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                      name="descripcion" rows="5"
                                      placeholder="Ingrese una descripción">{{$usuario->descripcion}}</textarea>
                            {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <p> <b>Asignación de Roles</b> </p>
                            <select id="rolesUsuario" class="form-control show-tick ms select2" disabled required name="id_roles[]"  multiple data-placeholder="{{--{{$rol->rol}}--}}">
                                @foreach($rol as $cat)
                                    <option
                                        value="{{$cat->id_rol}}" {{(in_array($cat->id_rol,$valores)) ? 'selected' : ''}}>{{$cat->rol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group" style="text-align: center">
                            <button hidden id="botonGuardar" class="btn btn-primary" type="submit">Guardar</button>
                            <a href="">
                                <button class="btn btn-danger" onclick="history.back()" type="">Regresar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
{{!!Form::close()}}
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/js_usuarios/script.js')}}"></script>
@endpush
