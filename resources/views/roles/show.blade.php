@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Detalle de Rol: </strong>{{$rol->rol}}</h3>
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
                    <div class="col-sm-10">
                        <p><b>Lista de Usuarios con Rol {{$rol->rol}}</b></p>
                        {{--<select name="id_usuario[]"  class="form-control show-tick ms select2" required multiple data-placeholder="Select">
                            @foreach($usuario as $cate)
                                <option value="{{$cate->id_usuario}}">{{$cate->nombre." ".$cate->apellido}} </option>
                            @endforeach
                        </select>--}}
                        <div class="table-responsive">
                            <table class="table table-hover product_item_list c_table theme-color mb-0">
                                <thead >
                                    <tr>
                                        <th style="text-align: center">Nombres y Apellidos</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                @foreach($usuario as $cate)
                                    <tbody">
                                    <tr>
                                        <td style="text-align: center">{{$cate->nombre." ".$cate->apellido}}</td>
                                        <td ><a href="{{URL::action('OpticaControllers\UsuarioController@edit',$cate->id_usuario)}}"><button class="btn btn-info">Editar</button></a></td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                       {{-- <div class="" style="text-align: center">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <a href="/roles"><button class="btn btn-danger" type="">Cancelar</button></a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection