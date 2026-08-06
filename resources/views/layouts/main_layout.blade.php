<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
    <link rel="icon" href="{{ asset("favicon.ico") }}">

    @include("layouts.partials.links")

    @php
        if (Cache::get('tema') === 'escuro') {
            $imagem_fundo = "$imagem.png";
        } else {
            $imagem_fundo = "$imagem" . "_noite.png";
        }
    @endphp
    <style>
        * {
            cursor: url("/assets/images/cursores/cursor.png"), auto;
        }

        .cursor:hover {
            cursor: url("/assets/images/cursores/cursor_batalha.png"), auto;
        }

        #fundo {
            background-image: url('{{ asset("assets/images/fundos/" . $imagem_fundo) }}');
        }
    </style>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body class="bg-dark fst-italic d-flex flex-column min-vh-100">
    <div id="fundo"></div>

    @include("layouts.partials.alertas")
    
    @include("layouts.navbar")

    @include("layouts.subnavbar")
    
    @yield("content")

    @include("layouts.direitos")

    <script src="{{ asset('assets/js/main_scripts.js') }}"></script>

    <img src="{{ asset('assets/images/gifs/' . (Cache::get('tema') === 'escuro' ? 'fogo_invertido.gif' : 'fogo.gif')) }}" class="gifs position-fixed bottom-0 start-50 translate-middle-x opacity-25 w-100 h-50">
</body>
</html>
