@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Tipos de Lentes')

@section('page-style')
{{-- Estilos para el Sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
{{-- Estilos para la jqueryDataTable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado</strong> Tipos de Lentes
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Tipo de Lente">
                        <a href="{{action('OpticaControllers\TipoLenteController@create')}}" class="btn btn-success btn-sm btn-raised waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tb-responsive dataTable">
                        <thead>
                            <tr>
                                <th>Tipo de Lente</th>
                                <th>Precio Base</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiposLentes as $tipoLente)
                                <tr>
                                    <td>{{$tipoLente->tipo_lente}}</td>
                                    <td>{{$tipoLente->precio}}</td>
                                    @if($tipoLente->estado == 1)
                                        <td><span class="badge badge-success">Activo</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Inactivo</span></td>
                                    @endif
                                    <td>
                                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar">
                                            <a href="{{action('OpticaControllers\TipoLenteController@edit',$tipoLente->id_tipo_lente)}}" class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-blue">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </span>
                                        @if($tipoLente->estado == 1)   
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja">
                                                <a href="{{action('OpticaControllers\TipoLenteController@destroy', $tipoLente->id_tipo_lente)}}" class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-red"
                                                    data-type="confirm"
                                                    data-title="Dar de Baja"
                                                    data-text="¿Deseas dar de baja el tipo de lente?"
                                                    data-obj="{{'Tipo de lente "'.$tipoLente->tipo_lente.'"'}}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </span>
                                        @else
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Reactivar">
                                                <a href="{{route('tipos-lentes.reactivar', $tipoLente->id_tipo_lente {{--['tipo_lente' => $tipoLente->id_tipo_lente]--}})}}" class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-green" 
                                                    id="reactivar"
                                                    data-value="{{'Tipo de Lente "'.$tipoLente->tipo_lente.'"'}}">
                                                    <i class="zmdi zmdi-check"></i>
                                                </a>
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
{{-- Scripts para el Sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>


{{-- Scripts para la jqueryDataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

{{-- Scripts para los botones de jqueryDataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script>
    $(function(){
        $('.js-sweetalert #reactivar').on('click', function(e){
            e.preventDefault();

            var URL = $(this).attr('href'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal({
                'title':"¿Estas seguro?",
                'text':'Se reactivara el '+$(this).data('value'),
                'icon':"warning",
                'buttons':{
                    'cancel':'Cancelar',
                    'confirm':{
                        'text':'Aceptar',
                        'className':'btn-warning'
                    }              
                },
                'dangerMode':false
            }).then((reactivar) => {
                if(reactivar)
                {
                    var form = $('<form>', {
                        'method':'POST',
                        'action':URL
                    });
                    var hiddenToken = $('<input>', {
                        'type':'hidden',
                        'name':'_token',
                        'value':csrf_token
                    });
                    var hiddenInput = $('<input>', {
                        'type':'hidden',
                        'name':'_method',
                        'value':'PUT'
                    });
                    swal({
                        'text':$(this).data('value')+' Actualizado',
                        'icon':'success',
                        'timer':2000,
                        'button':false
                    }).then(()=>{
                        form.append(hiddenInput).append(hiddenToken).appendTo('body').submit(); 
                    });
                }
                else{
                    swal({
                        'text':'¡Acción Cancelada!', 
                        'icon':'error'
                    });
                }
            });
        });
    });
</script>
@endsection