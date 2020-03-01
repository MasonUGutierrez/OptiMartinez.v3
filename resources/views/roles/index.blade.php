@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
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
                    <h3><strong>Listado de
                            Roles</strong> {{--<a href="roles/create"><button class="btn btn-success">Nuevo</button></a>--}}
                    </h3>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover product_item_list c_table theme-color mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th style="text-align: center">Nombre del Rol</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>
                            </thead>

                            @foreach($rol as $cat)
                                <tbody>
                                <tr>
                                    <td>{{$cat->id_rol}}</td>
                                    <td style="">{{$cat->rol}}</td>
                                    <td style="text-align: center">
                                        <a href="">
                                            <button class="btn btn-secondary">Detalles</button>
                                        </a>
                                        {{--<a href="" data-target="#modal-asignar-{{$cat->id_rol}}" data-toggle="modal">
                                            <button class="btn btn-info">Asignar a Usuario</button>
                                        </a>--}}
                                        <a href="{{URL::action('OpticaControllers\RolController@asignar',$cat->id_rol)}}" ><button class="btn btn-info">Asignar a Usuario</button></a>
                                    </td>
                                </tr>
                                </tbody>
                                @include('roles.modal')
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="body">
                    <ul class="pagination pagination-primary m-b-0">
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                        class="zmdi zmdi-arrow-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                        class="zmdi zmdi-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@stop