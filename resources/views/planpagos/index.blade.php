@extends('layout.master')
{{--@section('parentPageTitle', 'Pages')--}}
@section('title', 'Planes de Pagos')
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
                            <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Nuevo Plan de Pago">
                                <a id="botonN" style="color: white" class="btn btn-success btn-sm waves-float waves-effect" data-toggle="modal" data-target="#largeModal">
                                    <i class="zmdi zmdi-plus"></i>
                                </a>

                            </span>
                    </h2>
                </div>
                <div class="body align-center" style="background-color: #f5f5f5" >
                    <div class="row" id="aqui">

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
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{asset('assets/js/js_propios/js_planpago/script.js')}}"></script>
@endpush
