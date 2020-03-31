@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.css')}}"/>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3><strong>Planes de Pago</strong> <a href="planpago/create">
                            <button class="btn btn-success">Nuevo</button>
                        </a>
                    </h3>
                    <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                            data-target="#largeModal">MODAL - LARGE SIZE
                    </button>
                </div>
                <div class="body align-center">
                    <div class="row">
                        @foreach($planpago as $cat)
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white mb-3 " style="max-width: 18rem;">
                                    <div class="card-header" id="plan_pago">{{$cat->plan_pago}}</div>
                                    <div class="card-body">
                                        <p class="card-text" id="descripcion">{{$cat->descripcion}}</p>
                                    </div>
                                    <div class="card-footer " style="text-align: center">
                                        <!-- Mejor forma de poner los tooltips -->
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top"
                                              title="Ver Detalles">
                        <a href="{{URL::action('OpticaControllers\PlanPagoController@show',$cat->id_plan_pago)}}"
                           class="btn btn-raised btn-secondary waves-effect"><i
                                class="ti-search"></i></a>
                        </span>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top"
                                              title="Editar">
                        <a href="{{URL::action('OpticaControllers\PlanPagoController@edit',$cat->id_plan_pago)}}"
                           class="btn btn-raised btn-info waves-effect"><i
                                class="ti-pencil-alt"></i></a>
                        </span>
                                        <!-- Usando SweetAlert -->
                                        <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip"
                                              data-placement="top" title="Dar de Baja">
                        <a href="{{URL::action('OpticaControllers\PlanPagoController@destroy',$cat->id_plan_pago)}}"
                           class="btn btn-raised btn-danger waves-effect"
                           data-type="confirm"
                           data-title="Dar de Baja"
                           data-text="¿Desea eliminar el Plan de Pago: {{$cat->plan_pago}} ?"
                           data-obj="{{$cat->plan_pago}}"
                        >
                        <i class="ti-trash"></i>
                        </a>
                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                        crossorigin="anonymous"></script>
                <script></script>
            </div>
        </div>
    </div>
    {{--Modal para agregar nuevo plan de pago--}}
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Nuevo Plan de Pago</h4>
                </div>
                <div class="modal-body center">
                    <label for="">Nombre Plan de Pago</label>
                    <input type="text" class="form-control  {{ $errors->has('plan_pago') ? 'is-invalid' : '' }}"
                           id="plan_pago" required name="plan_pago"
                           value="{{old("plan_pago")}}" placeholder="Plan..."/>
                    {!! $errors->first('plan_pago', '<small class="invalid-feedback">:message</small>') !!}
                    <label for="">Descripcion del Plan de Pago</label>
                    <div>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                  id="descripcion" name="descripcion" required cols="30" placeholder="Descripcion..."
                                  rows="10">{{old("descripcion")}}</textarea>
                    </div>
                    {!! $errors->first('descripcion', '<small class="invalid-feedback">:message</small>') !!}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="guardar" onclick="saveData()" >Guardar</button>
                    <a href="">
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function saveData() {
            var plan_pago = $('#plan_pago').val();
            var descripcion = $('#descripcion').val();
            var token = '{{csrf_token()}}';
            var data = {plan_pago:plan_pago,descripcion:descripcion,_token:token};
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: data,
                url: "planpago",
                success:function (response) {
                    clearData();
                }
            })
        }
        function clearData(){
            $('#plan_pago').val('');
            $('#descripcion').val('');
        }
    </script>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@stop
