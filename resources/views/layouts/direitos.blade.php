@php
            
    $icones = ["laravel", "php", "html5", "javascript", "css", "bootstrap", "animate_css", "sweetalert", "mysql"];
    $links = ["laravel.com", "php.net", "developer.mozilla.org/en-US/docs/Glossary/HTML5", "developer.mozilla.org/pt-BR/docs/Web/JavaScript", "developer.mozilla.org/pt-BR/docs/Web/CSS", "getbootstrap.com", "animate.style", "sweetalert2.github.io", "mysql.com"];

@endphp

<footer class="animate__animated animate__fadeInUpBig mx-3 mt-5 mb-3">
    <div class="{{ session("tema") == "escuro" ? "bg-light border-primary" : "bg-black border-danger" }} rounded-2 border text-center shadow mx-auto" style="max-width: 619px;">
        <img src="{{ asset('assets/images/proprietario.png') }}" style="width: 35px; height: 35px;" class="border {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} rounded-start-2">
        <small class="text-white">
            <span class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"> © {{ date('Y') }} Jogo RPG - 
                <span id="direitos" class="me-1">TODOS OS DIREITOS RESERVADOS: Luciano Eduardo Stefanello da Silva</span>
            </span>
        </small>
    </div>
    <div class="d-flex gap-3 justify-content-center py-1 overflow-x-auto">
        @foreach(array_combine($icones, $links) as $icone => $link)
            <a href="http://{{ $link }}">
                <img src="{{ asset("assets/images/icones/$icone.png") }}" class="cursor icones botoes">
            </a>
        @endforeach
    </div>
</footer>