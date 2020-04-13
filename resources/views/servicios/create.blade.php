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
                    <h3><strong>Nuevo Servicio</strong></h3>
                </div>
                {!!Form::open(array('url'=>'servicios','method'=>'POST','autocomplete'=>'off')) !!}
                {{Form::token()}}
                <div class="body">
                    {{--<h2 class="card-inside-title">Basic Examples</h2>--}}
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre de Servicio</label>
                                <small class="text-muted">*Campo necesario</small>
                                <input type="text" class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}" required name="servicio"
                                       value="{{old("servicio")}}" placeholder="Servicio..."/>
                                {!! $errors->first('servicio', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12">
                                <label for="">Precio</label>
                                <small class="text-muted">*Campo necesario</small>
                                <input type="text" name="precio" required class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}" value="{{old("precio")}}"
                                       placeholder="Precio..."/>
                                {!! $errors->first('precio', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href="">
                                    <button class="btn btn-danger" type="reset">Cancelar</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
