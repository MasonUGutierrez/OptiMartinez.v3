<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Se modifico el icono aca -->
        <link rel="icon" href="{{asset('optica-icon.ico')}}" type="image/x-icon"> <!-- Favicon-->

        <!-- Este config('app.name') se trae el nombre de la aplicacion que esta en el archivo .env -->
        <title>{{ config('app.name') }} - @yield('title')</title>
        <meta name="description" content="@yield('meta_description', config('app.name'))">
        <meta name="author" content="@yield('meta_author', config('app.name'))">
        @yield('meta')
        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        @if (trim($__env->yieldContent('page-style')))
            @yield('page-style')
        @endif
        <!-- Custom Css -->
        <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
        {{-- Custom Theme Css --}}
        <link rel="stylesheet" href="{{asset('assets/css/themes.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fullcalendar/lib/main.min.css')}}">
        <style>
          /*  #calendar{
                color:#000 !important;
            }*/

            .fc .fc-event {
                border: 0;
                color: #000000 !important;
            }
        </style>
        @stack('after-styles')
    </head>

    <!-- Se modifico el color aca -->
    <?php
        $setting = !empty($_GET['theme']) ? $_GET['theme'] : '';
        $theme = "theme-blue";
        $menu = "";
        if ($setting == 'p') {
            $theme = "theme-purple";
        } else if ($setting == 'b') {
            $theme = "theme-blush";
        } else if ($setting == 'g') {
            $theme = "theme-green";
        } else if ($setting == 'o') {
            $theme = "theme-orange";
        } else if ($setting == 'bl') {
            $theme = "theme-cyan";
        } else {
            $theme = "theme-blue";
        }

        if (Request::segment(2) === 'rtl' ){
            $theme .= " rtl";
        }
    ?>
    <!-- <body class="<?= $theme ?>"> -->
    <body class="theme-blue">
        <!-- Se modifico el icono de carga aca -->
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="heartbit" src="{{asset('../assets/images/sistema-optica/logo/logo.svg')}}" width="120"  alt="Aero"></div>
                <p>Por favor, espere un momento...</p>
            </div>
        </div>

        <!-- Se agregan los sidebars aca -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        {{-- @include('layout.navbarright') --}}
        @include('layout.sidebar')
        {{-- @include('layout.rightsidebar') --}}
        <section class="content">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>@yield('title')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="zmdi zmdi-home"></i> Inicio</a></li>
                            @if (trim($__env->yieldContent('parentPageTitle')))
                                <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                            @endif
                            @if (trim($__env->yieldContent('title')))
                                <li class="breadcrumb-item active">@yield('title')</li>
                            @endif
                        </ul>
                        <!-- OJO: Boton que expande el menu lateral izq. en moviles -->
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>

                    <!-- Boton para ocultar el menu lateral derecho -->
                    <div class="col-lg-5 col-md-6 col-sm-12">
                    <!--     <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                        <!-- Yield para indicar el boton para agregar un registro, Nota: Me fije en la plantilla que aca ponian esos botones -->
                        {{-- Yielad para agregar los botones de regresar --}}
                        @yield('addButton')
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        @yield('modal')
        <!-- Scripts -->
        @stack('before-scripts')
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

        @if (trim($__env->yieldContent('page-script')))
            @yield('page-script')
        @endif

        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

        <!-- Script para habilitar los tooltips -->
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })
            $(document).ajaxComplete(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        @stack('after-scripts')
    </body>
</html>
