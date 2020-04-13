@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Detalle de Servicio: {{$servicio->servicio}}  </strong><a href="{{URL::action('OpticaControllers\ServicioController@edit',$servicio->id_servicio)}}"><button  class="btn btn-success">Editar Servicio</button></a></h3>
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
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre de Servicio</label>
                                <input type="text" class="form-control" disabled name="servicio" value="{{$servicio->servicio}}"  />
                            </div>
                            <div class="form-group col-12">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control" disabled value="{{$servicio->precio}}"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
