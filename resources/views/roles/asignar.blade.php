@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
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
                        <p><b>Lista de Usuarios</b></p>
                        <select name="id_usuario" class="form-control show-tick ms search-select"  data-placeholder="Select">
                            <option class="" disabled selected value> -- Selecciona un Usuario -- </option>
                            <?php
                                print_r($usuario);
                            ?>
                           {{-- @foreach($usuario as $cate)
                                <option value="{{$cate->id_usuario}}">{{$cate->nombre." ".$cate->apellido}} </option>

                            @endforeach--}}
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