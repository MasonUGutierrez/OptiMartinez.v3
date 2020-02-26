@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Nuevo Rol</strong> </h3>
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

                {!!Form::open(array('url'=>'roles','method'=>'POST','autocomplete'=>'off')) !!}
                {{Form::token()}}

                <div class="body">
                    {{--<h2 class="card-inside-title">Basic Examples</h2>--}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nombre de Nuevo Rol</label>
                                <input type="text" class="form-control" name="rol" placeholder="Nombre de Rol..." />
                            </div>
                            <div class="form-group" style="text-align: center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href=""><button class="btn btn-danger" type="reset">Cancelar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
@endsection