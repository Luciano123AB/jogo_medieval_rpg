<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
    <link rel="icon" href="{{ asset("favicon.ico") }}">

    @include("layouts.partials.links")

    @include("layouts.partials.styles.estilos")
</head>
<body class="bg-dark fst-italic">
    <div id="fundo"></div>

    @include("layouts.partials.alertas")
    
    @include("layouts.navbar")

    @include("layouts.subnavbar")
    
    @yield("content")

    @include("layouts.direitos")

    @include("layouts.partials.scripts.scripts")

    <img src="{{ asset('assets/images/gifs/' . (session('tema') == 'escuro' ? 'fogo_invertido.gif' : 'fogo.gif')) }}" class="gifs position-fixed bottom-0 start-50 translate-middle-x opacity-25 w-100 h-50">
</body>
</html>