<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('img/web/favicon.ico')}}"/>
        <title>Sabor a naranaja</title>
        @include('web.template.global_css')
        @stack('styles')
    </head>
    <body>
    @include('web.template.components._alert')
    @yield('content')
    @include('web.template.components._modal')
    @include('web.template.routes')
    @include('web.template.global_js')
    @stack('scripts')
    </body>
</html>
