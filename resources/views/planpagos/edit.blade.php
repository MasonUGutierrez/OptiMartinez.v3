@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Editar Plan de Pago: {{$planpago->plan_pago}}  </strong></h3>
                </div>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!!Form::model($planpago,['method'=>'PATCH','route'=>['planpago.update',$planpago->id_plan_pago]])!!}
                {{Form::token()}}
                <div class="body">
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre Plan de Pago</label>
                                <input type="text" class="form-control {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"  name="plan_pago" value="{{$planpago->plan_pago}}"  />
                                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12">
                                <label for="">Descripcion del Plan de Pago</label>
                                <div>
                                    <textarea name="descripcion" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" required cols="30" placeholder="Descripcion..." rows="10">{{$planpago->descripcion}}</textarea>
                                    {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                                </div>
                            </div>
                            <div class="form-group col-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href="/index"> <button class="btn btn-danger" type="">Cancelar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
