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
                    <h2><strong>Listado</strong> de Roles</h2>
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

                            <tbody id="tabla">
                               {{-- @foreach($rol as $cat)
                                    <tr>
                                    <td>{{$cat->id_rol}}</td>
                                    <td style="">{{$cat->rol}}</td>
                                    <td style="text-align: center">
                                        <a href="{{URL::action('OpticaControllers\RolController@show',$cat->id_rol)}}"><button class="btn btn-secondary">Detalles</button></a>
                                        --}}{{--<a href="" data-target="#modal-asignar-{{$cat->id_rol}}" data-toggle="modal">
                                            <button class="btn btn-info">Asignar a Usuario</button>
                                        </a>--}}{{--
                                        <a href="{{URL::action('OpticaControllers\RolController@asignar',$cat->id_rol)}}" ><button class="btn btn-info">Asignar a Usuario</button></a>
                                    </td>
                                </tr>

                                @endforeach--}}
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('roles.modal-detail')
    @include('roles.modal-assign')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/js_roles/script.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop
