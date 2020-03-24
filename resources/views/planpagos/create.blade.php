@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Nuevo Plan de Pago</strong></h3>
                </div>
                {!!Form::open(array('url'=>'planpago','method'=>'POST','autocomplete'=>'off')) !!}
                {{Form::token()}}
                <div class="body">
                    {{--<h2 class="card-inside-title">Basic Examples</h2>--}}
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre Plan de Pago</label>
                                <input type="text" class="form-control {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}" required name="plan_pago"
                                       value="{{old("plan_pago")}}" placeholder="Plan..."/>
                                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12">
                                <label for="">Descripcion del Plan de Pago</label>
                                <div>
                                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" required cols="30" placeholder="Descripcion..." rows="10">{{old("descripcion")}}</textarea>
                                </div>
                                {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href="">
                                    <button class="btn btn-danger" type="reset">Cancelar</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
