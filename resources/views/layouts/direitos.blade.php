@php
            
    $icones = ["laravel", "php", "html5", "javascript", "css", "bootstrap", "animate_css", "gsap", "jsdelivr", "sweetalert", "mysql"];
    $links = ["laravel.com", "php.net", "developer.mozilla.org/en-US/docs/Glossary/HTML5", "developer.mozilla.org/pt-BR/docs/Web/JavaScript", "developer.mozilla.org/pt-BR/docs/Web/CSS", "getbootstrap.com", "animate.style", "gsap.com", "cdn.jsdelivr.net", "sweetalert2.github.io", "mysql.com"];
    $temas = ["light", "primary", "escuro"];
        
    if (session("tema") == "claro" || !session()->has("tema")) {
        $temas = ["dark", "danger", "claro"];
    }
@endphp

<footer class="animate__animated animate__fadeInUpBig mx-3 mt-5 mb-3">
    <div class="bg-{{ $temas[0] }} border-{{ $temas[1] }} rounded-2 border text-center shadow mx-auto" style="max-width: 619px;">
        <img src="{{ asset('assets/images/proprietario.png') }}" style="width: 35px; height: 35px;" class="border border-{{ $temas[1] }} rounded-start-2 rounded-end-2">
        <small class="text-white">
            <span class="cor_fontes_{{ $temas[2] }}">
                <span id="direitos">TODOS OS DIREITOS RESERVADOS: Luciano Eduardo Stefanello da Silva</span>
                <br>
                © 2025 - {{ date("Y") }} {{ env("APP_NAME") }}
            </span>
        </small>
    </div>
    <div class="d-flex flex-wrap gap-3 justify-content-center py-2">
        @foreach(array_combine($icones, $links) as $icone => $link)
            <a href="http://{{ $link }}">
                <img src="{{ asset("assets/images/icones/$icone.png") }}" class="cursor icones botoes">
            </a>
        @endforeach
    </div>
</footer>