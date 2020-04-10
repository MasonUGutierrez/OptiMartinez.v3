@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.css')}}"/>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Listado de Servicios</strong> <a href="#">
                            <button class="btn btn-success" data-toggle="modal" data-target=".servicioadd">Nuevo</button>
                        </a></h3>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover product_item_list c_table theme-color mb-0">
                            <thead>
                            <tr style="text-align: center">
                                <th>Servicio</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="tablas" style="text-align: center">
                            {{-- @foreach($servicio as $cat)
                                 <tr>
                                 <td >{{$cat->servicio}}</td>
                                 <td>{{$cat->precio}}</td>
                                 <td>
                                     <!-- Mejor forma de poner los tooltips -->
                                     <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                     <a href="{{URL::action('OpticaControllers\ServicioController@show',$cat->id_servicio)}}" class="btn btn-raised btn-secondary waves-effect"><i class="ti-search"></i></a>
                                 </span>

                                     <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                     <a href="{{URL::action('OpticaControllers\ServicioController@edit',$cat->id_servicio)}}" class="btn btn-raised btn-info waves-effect"><i class="ti-pencil-alt"></i></a>
                                 </span>
                                     <!-- Usando SweetAlert -->
                                     <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                     <a href="{{URL::action('OpticaControllers\ServicioController@destroy',$cat->id_servicio)}}" class="btn btn-raised btn-danger waves-effect"
                                        data-type="confirm"
                                        data-title="Dar de Baja"
                                        data-text="¿Estas seguro en eliminar el servicio: {{$cat->servicio}} ?"
                                        data-obj="{{$cat->servicio}}"
                                     >
                                         <i class="ti-trash"></i>
                                     </a>
                                 </span>
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
    @include('servicios.modal-edit')
    @include('servicios.modal-new')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{asset('assets/js/js_propios/js_servicios/script.js')}}"></script>
@stop
