@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Detalle de Usuario: {{$usuario->nombre}}  </strong><a href="{{URL::action('OpticaControllers\UsuarioController@edit',$usuario ->id_usuario)}}"><button  class="btn btn-success">Editar Registro</button></a></h3>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Codigo de Minsa</label>
                                <input type="text" class="form-control" disabled name="cod_minsa" value="{{$usuario->cod_minsa}}" placeholder="Codigo de Minsa..." />
                            </div>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control" disabled value="{{$usuario->nombre}}" placeholder="Nombre..." />
                            </div>
                            <div class="form-group">
                                <label for="">Apellido</label>
                                <input type="text"  name="apellido" class="form-control" disabled value="{{$usuario->apellido}}" placeholder="Apellido..." />
                            </div>
                            <div class="form-group">
                                <label for="">Cedula de indentidad</label>
                                <input type="text" name="cedula" class="form-control" disabled value="{{$usuario->cedula}}" placeholder="Cedula..." />
                            </div>
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="text" name="telefono" class="form-control" disabled value="{{$usuario->telefono}}" placeholder="Telefono..." />
                            </div>
                            <div class="form-group">
                                <label for="">Correo Electronico</label>
                                <input type="email" name="correo" class="form-control" disabled value="{{$usuario->correo}}" placeholder="Correo..." />
                            </div>
                            <div class="form-group">
                                <label ><b>Foto de perfil</b></label>
                                <div class="form-group">
                                    <img src="/imagenes/usuarios/{{$usuario->dir_foto}}" class="img-thumbnail" width="300" alt="img">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" name="contraseña" class="form-control" disabled value="{{$usuario->contraseña}}" placeholder="Nueva Contraseña..." />
                            </div>
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea  class="form-control" name="descripcion" rows="5" disabled placeholder="Ingrese una descripción">{{$usuario->descripcion}}</textarea>
                            </div>
                                {{--<div class="form-group" style="text-align: center">
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                    <a href="/index"> <button class="btn btn-danger" type="">Cancelar</button></a>
                                </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection