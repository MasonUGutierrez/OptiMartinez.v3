@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales')

@section('page-style')
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado</strong> de Materiales
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Material">
                        <a href="{{action('OpticaControllers\TipoMaterialController@create')}}" 
                            class="btn btn-success btn-sm btn-raised waves-float waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                
            </div>
        </div>    
    </div>    
</div>    
@endsection

@section('page-script')    
@endsection