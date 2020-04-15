@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Tipos de Marcos')

@section('page-style')
{{-- Estilos para los sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
{{-- Estilos para la Jquery DataTable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado</strong> Tipos de Marcos
                <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Tipo de Marco">
                    <a href="{{URL::action('OpticaControllers\TipoMarcoController@create')}}"class="btn btn-success btn-raised btn-sm waves-effect waves-light">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dt-responsive dataTable">
                        <thead>
                            <tr>
                                <th>Tipo de Marco</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiposMarcos as $tMarco)
                                <tr>
                                    <td>{{$tMarco->tipo_marco}}</td>
                                    <td>
                                        @if($tMarco->estado == 1)
                                            <span class="badge badge-success">Activo</span>   
                                        @else
                                            <span class="badge badge-danger">Inactivo</span> 
                                        @endif                                        
                                    </td>
                                    <td>                                        
                                        @if($tMarco->estado == 1)
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja">
                                                <a class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-red" 
                                                   href="{{URL::action('OpticaControllers\TipoMarcoController@destroy', $tMarco->id_tipo_marco)}}"
                                                   data-type="confirm"
                                                   data-title="Dar de Baja"
                                                   data-text="¿Deseas dar de baja el tipo de marco?"
                                                   data-obj="{{$tMarco->tipo_marco}}">
                                                <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </span>
                                        @else
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Reactivar">
                                                <a class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-green" href="{{URL::action('OpticaControllers\TipoMarcoController@update', $tMarco->id_tipo_marco)}}" id="activar"><i class="zmdi zmdi-check"></i></a>
                                            </span>
                                        @endif 
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
@endsection

@section('page-script')
{{-- Scripts para los sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>


{{-- Scripts para la Jquery DataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
{{-- Scripts para los botones de Jquery DataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script>
    // Funcion para ejecutar codigo Javascript despues de que se haya cargado la pagina
    $(function(){
        // Funcion para el evento click en el boton para reactivar un tipo de marco descontinuado
        $('.js-sweetalert #activar').on('click', function(e){
            e.preventDefault();
            var URL = $(this).attr('href'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                'title': '¿Estas seguro?',
                'text' : 'Se reactivara el tipo de marco seleccionado ',
                'icon': 'warning',
                'buttons': true,
                'dangerMode': false,
            }).then((willUpdate)=>{
                if(willUpdate){
                    var form = $('<form>', {
                        'method':'POST',
                        'action':URL
                    });
                    var hiddenInput = $('<input>',{
                        'type':'hidden',
                        'name':'_method',
                        'value':'PUT'
                    });
                    var hiddenToken = $('<input>',{
                        'type':'hidden',
                        'name':'_token',
                        'value':csrf_token
                    });

                    swal({
                        'text': 'Tipo de Marco Actualizado',
                        'icon': 'success',
                        'timer': 2000,
                        'button': false,
                        /* 'button': {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        } */
                    }).then((value) => {
                        form.append(hiddenInput).append(hiddenToken).appendTo('body').submit();                    
                    });
                    // Nota: La funcion flecha () => {} es igual que enviar una funcion anonima function(){} o la definicion de una funcion
                }
                else{
                    swal({
                        'text': 'Accion Cancelada',
                        'icon': 'error'
                    });
                }
            });
        });
    });
</script>
@endsection