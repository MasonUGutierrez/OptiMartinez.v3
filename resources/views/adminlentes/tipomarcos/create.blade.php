@extends('layout.master')

@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Estilos de Marcos / Agregar')

@section('content')
<form action="{{route('tipos-marcos.store')}}" method="post">
@csrf
{{-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Agregar</strong> Nuevo Estilo de Marco</h2>
                </div>            
                <div class="body">
                    <div class="form-group">
                        <label for="tipo_marco">Estilo de Marco</label>
                        <input type="text" name="tipo_marco" id="tipo_marco" class="form-control {{$errors->has('tipo_marco') ? 'is-invalid' : ''}}" placeholder="Ej: Cuadrado, Ovalado, Economico, etc." value="{{old('tipo_marco')}}">
                        {!!$errors->first('tipo_marco', '<span class="invalid-feedback">:message</span>')!!}
                    </div>
                </div>            
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-raised btn-primary waves-effect waves-light" value="Aceptar">
                        <input type="button" class="btn btn-raised btn-danger waves-effect waves-light" value="Cancelar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-script')
@endsection