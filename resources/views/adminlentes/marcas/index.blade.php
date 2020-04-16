@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcas')

@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
@endsection

@section('addButton')
    <span class="d-inline-block float-right" data-toggle="tooltip" tabindex="0" title="Agregar Marca">
        <a class="btn btn-success btn-icon" href="{{URL::action('OpticaControllers\MarcaController@create')}}" style="color:#fff"><i class="zmdi zmdi-plus"></i></a>
    </span>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Marcas</strong> Asociadas
                        <span class="d-inline-block" data-toggle="tooltip" title="Agregar Marca" tabindex="0">
                            <a href="{{URL::action('OpticaControllers\MarcaController@create')}}" class="btn btn-success btn-sm btn-raised waves-float waves-effect waves-light" style="color:#fff"><i class="zmdi zmdi-plus"></i></a>
                        </span>
                    </h2>
                </div>
                <div class="file_manager">
                    <div class="row clearfix">
                        @foreach ($marcas as $marca)
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <a href="{{URL::action('OpticaControllers\MarcaController@show', $marca->id_marca)}}" class="file">                                        
                                        <!-- Botones -->
                                        <div class="hover">
                                            <!-- button para editar el registro -->
                                            <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar Marca">
                                                <button type="button"
                                                        id="btn-edit"
                                                        class="btn btn-icon btn-icon-mini btn-round btn-primary"
                                                        {{-- data-dir="{{ route('marcas.edit',['marca'=>$marca->id_marca]) }}"> --}}
                                                        {{-- data-dir="{{ URL::action('OpticaControllers\MarcaController@edit', $marca->id_marca) }}"> --}}
                                                        data-dir="/admin-lentes/marcas/{{$marca->id_marca}}/edit">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                            </span>
                                            <!-- button para eliminar el registro -->
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Eliminar Marca">
                                                <button type="button" 
                                                        data-type="confirm"
                                                        data-dir="{{URL::action('OpticaControllers\MarcaController@destroy', $marca->id_marca)}}"
                                                        data-text="Se dará de baja la marca {{'"'.$marca->marca.'"'}}"
                                                        data-obj="Marca {{'"'.$marca->marca.'"'}}"
                                                        class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="image">
                                            <img src="{{asset('storage/imagenes/marcas/'.$marca->img)}}"  class="img-fluid" alt="marca img" />
                                        </div>
                                        <div class="file-name">
                                            <p class="m-b-5 text-muted">{{$marca->marca}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{$marcas->links()}}
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script>
        // $(funcion() {
            $('.hover #btn-edit').on('click', function(e){
                e.preventDefault();

                $dir = $(this).data('dir');

                // Propiedad del BOM para redireccionar
                window.location.href = $dir;
            });
        // })
    </script>
@endsection