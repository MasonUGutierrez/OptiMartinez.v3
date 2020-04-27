@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcas / Detalles')

@section('page-style')
{{-- Estilos del sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
{{-- Estilos del Jquery Datatable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
{{-- Ocupar Jquery DataTable (se tiene que configurar) o las tablas definidas --}}
{{-- Row para datos generales de la marca --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Datos</strong> Marca
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar Marca">
                        <a class="btn btn-primary btn-sm btn-raised waves-float waves-effect waves-light" href="{{URL::action('OpticaControllers\MarcaController@edit', $marca->id_marca)}}">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                {{-- <h2 class="card-inside-title">Marca</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" id="marca" name="marca" class="form-control"  value="{{$marca->marca}}">
                        </div>
                    </div>
                </div> --}}
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" class="form-control" disabled value="{{$marca->marca}}">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Row para mostrar los marcos por la marca --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Marcos</strong> Registrados
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Marco">
                        <a class="btn btn-success btn-sm btn-raised waves-float waves-effect waves-light" href="{{URL::action('OpticaControllers\MarcoController@create')}}">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dt-responsive theme-color dataTable">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Cod. Marco</th>
                                <th>Precio (C$)</th>
                                <th>Existencia</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marca->marcos as $marco)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{asset('storage/imagenes/marcos/'.$marco->dir_foto)}}" alt="marco.img" style="height:48px;width:48px;">
                                    </td>
                                    <td>{{$marco->cod_marco}}</td>
                                    <td>{{$marco->precio}}</td>
                                    <td>{{$marco->c_existencia}}</td>
                                    {{-- Botones de opciones --}}
                                    <td>
                                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Ver Detalles">
                                            <a href="{{route('marcos.show', $marco->id_marco)}}" class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-blue">
                                                <i class="zmdi zmdi-search"></i>
                                            </a>
                                        </span>
                                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar">
                                            <a href="{{URL::action('OpticaControllers\MarcoController@edit', $marco->id_marco)}}" class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-green">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </span>
                                        <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Eliminar">
                                            <a href="{{action('OpticaControllers\MarcoController@destroy', $marco->id_marco)}}" class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-red"
                                                data-type="confirm"
                                                data-title="Dar de Baja"
                                                data-text="¿Deseas eliminar el marco {{$marco->cod_marco}}?"
                                                data-obj="{{$marco->cod_marco}}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- Row para el boton de regresar --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <a href="{{url()->previous()}}" class="btn btn-danger btn-raised waves-effect waves-light">Regresar</a>
        </div>
    </div>
</div>
@endsection

@section('page-script')
{{-- Librerias para el sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

{{-- Librerias para el jquery dataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
{{-- Botones para el dataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection

@push('after-scripts')
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush