@extends('layout.master')

@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcas / Editar')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Editar</strong> Marca</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca" placeholder="Ej.: Ray-Ban, Converse, Guess, etc."/>
                            @if($errors->has('marca'))
                                <span class="invalid-feedback">{{ $message }}<span>
                            @endif
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}}"></script>
@endsection