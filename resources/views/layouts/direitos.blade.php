@php
            
    $icones = ["laravel", "php", "html5", "javascript", "css", "bootstrap", "animate_css", "gsap", "jsdelivr", "sweetalert", "mysql"];
    $links = ["laravel.com", "php.net", "developer.mozilla.org/en-US/docs/Glossary/HTML5", "developer.mozilla.org/pt-BR/docs/Web/JavaScript", "developer.mozilla.org/pt-BR/docs/Web/CSS", "getbootstrap.com", "animate.style", "gsap.com", "cdn.jsdelivr.net", "sweetalert2.github.io", "mysql.com"];
    $temas = ["light", "primary", "escuro"];
        
    if (session("tema") == "claro" || !session()->has("tema")) {
        $temas = ["black", "danger", "claro"];
    }
@endphp

<div id="espacamento"></div>
<footer id="rodape" class="bg-{{ $temas[0] }} border-{{ $temas[1] }} border-5 rounded-top-5 text-center mt-auto py-3">
    <div class="d-flex justify-content-center gap-5 flex-wrap align-items-center">
        <div>
            <img src="{{ asset("assets/images/proprietario.png") }}" style="width: 35px; height: 35px;" class="border border-{{ $temas[1] }} rounded-2">
            <small class="text-white">
                <span class="cor_fontes_{{ $temas[2] }}">
                    <span id="direitos">TODOS OS DIREITOS RESERVADOS: Luciano Eduardo Stefanello da Silva</span>
                    <br>
                    © 2025 - {{ date("Y") }} {{ env("APP_NAME") }}
                </span>
            </small>
        </div>
        <div>
            <h6 class="cor_fontes_{{ $temas[2] }}">Tecnologias:</h6>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                @foreach(array_combine($icones, $links) as $icone => $link)
                    <a href="http://{{ $link }}">
                        <img src="{{ asset("assets/images/icones/$icone.png") }}" class="cursor icones botoes">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>