@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Detalle Plan de Pago: {{$planpago->plan_pago}}  </strong><a href="{{URL::action('OpticaControllers\PlanPagoController@edit',$planpago->id_plan_pago)}}"><button  class="btn btn-success">Editar Plan Pago</button></a></h3>
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
                <div class="body">
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Plan de Pago</label>
                                <input type="text" class="form-control" disabled name="planpago" value="{{$planpago->plan_pago}}"  />
                            </div>
                            <div class="form-group col-12">
                                <label for="">Descripcion del Plan de Pago</label>
                                <div>
                                    <textarea name="descripcion" disabled required cols="30" rows="10">{{$planpago->descripcion}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
