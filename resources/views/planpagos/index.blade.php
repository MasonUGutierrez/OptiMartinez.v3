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
                    <h3><strong>Planes de Pago</strong> <a href="planpago/create">
                            <button class="btn btn-success">Nuevo</button>
                        </a></h3>
                </div>
                <div class="body align-center">
                    <div class="row">
                        @foreach($planpago as $cat)
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white mb-3 " style="max-width: 18rem;">
                                    <div class="card-header">{{$cat->plan_pago}}</div>
                                    <div class="card-body">
                                        <p class="card-text">{{$cat->descripcion}}</p>
                                    </div>
                                    <div class="card-footer " style="text-align: center">
                                        <!-- Mejor forma de poner los tooltips -->
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top"
                                              title="Ver Detalles">
                                                    <a href="{{URL::action('OpticaControllers\PlanPagoController@show',$cat->id_plan_pago)}}"
                                                       class="btn btn-raised btn-secondary waves-effect"><i
                                                            class="ti-search"></i></a>
                                </span>

                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top"
                                              title="Editar">
                                                    <a href="{{URL::action('OpticaControllers\PlanPagoController@edit',$cat->id_plan_pago)}}"
                                                       class="btn btn-raised btn-info waves-effect"><i
                                                            class="ti-pencil-alt"></i></a>
                                </span>
                                        <!-- Usando SweetAlert -->
                                        <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top" title="Dar de Baja">
                                                    <a href="{{URL::action('OpticaControllers\PlanPagoController@destroy',$cat->id_plan_pago)}}"
                                                       class="btn btn-raised btn-danger waves-effect"
                                                       data-type="confirm"
                                                       data-title="Dar de Baja"
                                                       data-text="¿Desea eliminar el Plan de Pago: {{$cat->plan_pago}} ?"
                                                       data-obj="{{$cat->plan_pago}}"
                                                    >
                                                        <i class="ti-trash"></i>
                                                    </a>
                                </span>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                    {{--<div class="table-responsive">
                        <table class="table table-hover product_item_list c_table theme-color mb-0">
                            <thead>
                            <tr style="text-align: center">
                                <th>Plan de Pago</th>
                                <th >Opciones</th>
                            </tr>
                            </thead>

                            @foreach($planpago as $cat)
                                <tbody style="text-align: center">
                                <tr>
                                    <td >{{$cat->plan_pago}}</td>
                                    <td>
                                        <!-- Mejor forma de poner los tooltips -->
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                        <a href="{{URL::action('OpticaControllers\PlanPagoController@show',$cat->id_plan_pago)}}" class="btn btn-raised btn-secondary waves-effect"><i class="ti-search"></i></a>
                                    </span>

                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <a href="{{URL::action('OpticaControllers\PlanPagoController@edit',$cat->id_plan_pago)}}" class="btn btn-raised btn-info waves-effect"><i class="ti-pencil-alt"></i></a>
                                    </span>
                                        <!-- Usando SweetAlert -->
                                        <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                        <a href="{{URL::action('OpticaControllers\PlanPagoController@destroy',$cat->id_plan_pago)}}" class="btn btn-raised btn-danger waves-effect"
                                           data-type="confirm"
                                           data-title="Dar de Baja"
                                           data-text="¿Estas seguro en eliminar el Plan de Pago: {{$cat->plan_pago}} ?"
                                           data-obj="{{$cat->plan_pago}}"
                                        >
                                            <i class="ti-trash"></i>
                                        </a>
                                    </span>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop
