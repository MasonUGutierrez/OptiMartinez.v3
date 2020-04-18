@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales / Agregar')

@section('page-style')
@endsection

@section('content') 
{!! Form::open(['action'=>'OpticaControllers\TipoMaterialController@store', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{!! Form::token() !!}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Agregar</strong> Nuevo Material</h2>
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