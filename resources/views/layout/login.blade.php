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
        <link rel="stylesheet" href="{{ asset('assets/css/loginCss.css')}} ">
    </head>
    <body>
        
    </body>
</html>