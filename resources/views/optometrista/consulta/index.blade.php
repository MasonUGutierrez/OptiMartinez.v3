@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Listado de<strong> Consultas</strong>
                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nueva Consulta">
                        <a href="#" data-toggle="modal" data-target=".newConsulta" class="btn btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-assignment"></i></a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <h5>Tabla</h5>
            </div>
        </div>
    </div>
</div>
@include('optometrista.consulta.add-consulta')
@endsection
