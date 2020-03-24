@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <style>
        label {
            font-size: 18px;
        }

        small {
            font-size: 10px;
            float: right;
        }
    </style>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Editar Servicio: {{$servicio->servicio}}  </strong></h3>
                </div>
                {!!Form::model($servicio,['method'=>'PATCH','route'=>['servicios.update',$servicio->id_servicio]])!!}
                {{Form::token()}}
                <div class="body">
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre de Servicio</label>
                                <input type="text" class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}"  name="servicio" value="{{$servicio->servicio}}"  />
                                {!! $errors->first('servicio', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}"  value="{{$servicio->precio}}"  />
                                {!! $errors->first('precio', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href="/index"> <button class="btn btn-danger" type="">Cancelar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
