@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales / Editar')

@section('page-style')
@endsection

@section('content')  
{!! Form::model($tipoMaterial, ['action'=>['OpticaControllers\TipoMaterialController@update',$tipoMaterial->id_tipo_material], 'method'=>'PUT', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Editar</strong> Material</h2>
            </div>
            <div class="body">
                
            </div>
        </div>    
    </div>    
</div> 
{!! Form::close() !!}
@endsection

@section('page-script')    
@endsection