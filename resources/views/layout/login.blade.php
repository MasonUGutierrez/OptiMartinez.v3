<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charse="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="icon" type="image/x-icon" href=" {{asset('optica-icon.ico')}} ">
        <meta name="author" content="@yield('meta_author', config('app.name'))">
        <meta name="description" content="@yield('meta_description', config('app.name'))">

        <title>Iniciar Sesión - {{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/loginCSS.css')}}">
    </head>
    <body>
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="heartbit" src="{{asset('../assets/images/sistema-optica/logo/logo.svg')}}" width="120"  alt="Optica Martinez Logo"></div>
                <p>Por favor, espere un momento...</p>
            </div>
        </div>
        <div class="body-cover">
        </div>
        <div class="login-box text-muted">
            <div class="logo-img">
                <img src="{{asset('assets/images/sistema-optica/logo/logo2.svg')}}" alt="Logo Sistema Optica Martinez">
            </div>
            <div class="login-intro text-center">
                <h3 class="font-18">Bienvenido <span class="point">!</span></h3>
                <p class="font-14">Inicia sesión para continuar al sistema<span class="point">.</span></p>
            </div>
            <div class="login-form">
                <form method="POST">
                    @csrf
                    {{-- {{csrf-field()}}
                    <input type="hidden" name="_token" value="{{csrf-token()}}"> --}}
                    <div class="form-group">
                        <label for="email">Correo: </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="zmdi zmdi-key"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
                        </div>
                    </div>
                    <a class="forgot-password" href="#" ><i class="zmdi zmdi-lock-outline mr-1"></i> Olvidaste tu contraseña?</a>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="login">Inicar Sesion <i class="zmdi zmdi-sign-in ml-2"></i></button>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <p class="font-14"><span class="point">© 2019</span> - all right reserves</p>
            </div>
        </div>

        <div class="sign">
            <p><span>Elaborado por: </span> Mason Urbina y Carlos Arroliga</p>
        </div>
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    </body>
</html>