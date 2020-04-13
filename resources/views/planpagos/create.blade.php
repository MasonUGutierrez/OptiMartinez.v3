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
                <meta name="_token" content="{{csrf_token()}}"/>
                <div class="body">
                    {{--<h2 class="card-inside-title">Basic Examples</h2>--}}
                    <div class="row clearfix">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nombre Plan de Pago</label>
                                <input type="text"
                                       class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                                       id="plan_pago" required name="plan_pago"
                                       value="{{old("plan_pago")}}" placeholder="Plan..."/>
                                {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12">
                                <label for="">Descripcion del Plan de Pago</label>
                                <div>
                                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                              id="descripcion" name="descripcion" required cols="30"
                                              placeholder="Descripcion..." rows="10">{{old("descripcion")}}</textarea>
                                </div>
                                {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                            </div>
                            <div class="form-group col-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit" id="">Guardar</button>
                                <a href="">
                                    <button class="btn btn-danger" type="reset">Cancelar</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                {{--<script src="http://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                        crossorigin="anonymous">
                </script>
                --}}
            </div>
        </div>
    </div>

@endsection

