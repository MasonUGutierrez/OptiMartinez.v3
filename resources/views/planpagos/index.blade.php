@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.css')}}"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Planes </strong>de Pago
                            <button type="button" id="botonN" class="btn btn-success waves-effect m-r-20" data-toggle="modal"
                                    data-target="#largeModal">Nuevo
                            </button>
                    </h2>
                </div>
                <div class="body align-center">
                    <div class="row" id="aqui">
                      {{--  @foreach($planpago as $cat)
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white mb-3 " style="max-width: 18rem;">
                                    <div class="card-header" id="">{{$cat->plan_pago}}</div>
                                    <div class="card-body">
                                        <p class="card-text" id="">{{$cat->descripcion}}</p></div>
                                    <div class="card-footer " style="text-align: center">
                                        <!-- Mejor forma de poner los tooltips -->
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                            <a href="{{URL::action('OpticaControllers\PlanPagoController@show',$cat->id_plan_pago)}}" class="btn btn-raised btn-secondary waves-effect">
                                                <i class="ti-search"></i>
                                            </a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                             <a href="{{URL::action('OpticaControllers\PlanPagoController@edit',$cat->id_plan_pago)}}" class="btn btn-raised btn-info waves-effect">
                                                 <i class="ti-pencil-alt"></i>
                                             </a>
                                        </span>
                                        <!-- Usando SweetAlert -->
                                        <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                             <a href="{{URL::action('OpticaControllers\PlanPagoController@destroy',$cat->id_plan_pago)}}"
                                               class="btn btn-raised btn-danger waves-effect"
                                               data-type="confirm"
                                               data-title="Dar de Baja"
                                               data-text="¿Desea eliminar el Plan de Pago: {{$cat->plan_pago}} ?"
                                               data-obj="{{$cat->plan_pago}}">
                                                 <i class="ti-trash"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach--}}
                    </div>
                </div>
                <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                        crossorigin="anonymous"></script>
                <script></script>
            </div>
        </div>
    </div>
    {{--Modal para agregar nuevo plan de pago--}}
    @include('planpagos.modal-add')
    @include('planpagos.modal-edit')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{asset('assets/js/js_propios/js_planpago/script.js')}}"></script>
@stop
