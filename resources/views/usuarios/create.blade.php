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
                <h3><strong>Nuevo Usuario</strong> </h3>
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

            {!!Form::open(array('url'=>'usuarios','method'=>'POST','files'=>true,'autocomplete'=>'off')) !!}
            {{Form::token()}}

            <div class="body">
                {{--<h2 class="card-inside-title">Basic Examples</h2>--}}
                <div class="row clearfix">

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Codigo de Minsa</label>
                            <input type="text" class="form-control" required name="cod_minsa" value="{{old("cod_minsa")}}" placeholder="Codigo de Minsa..." />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" required class="form-control" value="{{old("nombre")}}" placeholder="Nombre..." />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Apellido</label>
                            <input type="text"  name="apellido" required class="form-control" value="{{old("apellido")}}" placeholder="Apellido..." />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Cedula de indentidad</label>
                            <input type="text" name="cedula" required  class="form-control" value="{{old("cedula")}}" placeholder="Cedula..." />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" class="form-control" value="{{old("telefono")}}" placeholder="Telefono..." />
                        </div>
                        <div class="form-group col-12">
                            <label for="">Correo Electronico</label>
                            <input type="email" name="correo" required value="{{old("correo")}}" class="form-control" placeholder="Correo..." />
                        </div>
                        {{--<div class="form-group">
                            <label for="dir_foto">Foto de perfil</label>
                            <input type="file" name="dir_foto" value="{{old("dir_foto")}}" class="form-control" />
                        </div>--}}
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Contraseña</label>
                            <input type="password" name="contraseña" value="" required class="form-control" placeholder="Nueva Contraseña..." />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Verificar Contraseña</label>
                            <input type="password" name="ccontraseña" value="" required class="form-control" placeholder="Confirma Contraseña..." />
                        </div>
                        <div class="form-group col-12">
                            <label for="">Descripción</label>
                            <textarea  class="form-control" name="descripcion"  rows="5" placeholder="Ingrese una descripción">{{old("descripcion")}}</textarea>
                        </div>
                        <div class="form-group col-8">
                            <p> <b>Asignación de Roles</b> </p>
                            <select class="form-control show-tick ms select2" required name="id_roles[]"  multiple data-placeholder="Select">
                            @foreach($rol as $cat)
                                <option value="{{$cat->id_rol}}">{{$cat->rol}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12" style="text-align: center">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <a href=""><button class="btn btn-danger" type="reset">Cancelar</button></a>
                        </div>

                    </div>
                </div>
            </div>
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
