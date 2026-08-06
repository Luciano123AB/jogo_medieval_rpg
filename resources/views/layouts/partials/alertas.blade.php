@php

    $alerta = session("alerta");
    $pagina = $alerta["pagina"] ?? null;
    $chaveLancado = "alerta_{$pagina}_lancado";
    $icone = "";
    $temas = ["#f8f9fa", "primary", "#493722", "secondary", "escuro"];

    if (session("alerta.icone") == "⚔️") {
        $icone = "⚔️";
    }

    if (Cache::get('tema') === 'claro' || !Cache::has('tema')) {
        $temas = ["#323232", "danger", "#e5a350", "danger", "claro"];
    }
@endphp

@if($alerta && !session()->has($chaveLancado))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ $temas[0] }}",
            imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'>" +
                        "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                            "{{ session('alerta.titulo') }}" +
                        "</span>" +
                        "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                            "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                "<i class='cursor bi {{ session('alerta.icone') }} me-1'></i>" +
                            "</div>" +
                            "{{ $icone }}" +
                            "{{ session('alerta.texto') }}" +
                        "</span>" +
                    "</label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring btn-{{ $temas[3] }} focus-ring-{{ $temas[1] }} btn-sm rounded-pill'>" +
                        "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                            "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                            "</div>" +
                            "OK" +
                        "</span>" +
                    "</button>",
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            },
            backdrop: `
                rgba(0, 0, 0, 0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
        });
    </script>

    @php
        session([$chaveLancado => true]);
    @endphp
@endif

@if(session("alerta_confirmar"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ $temas[0] }}",
            imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'>" +
                        "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                            "{{ session('alerta_confirmar.titulo') }}" +
                        "</span>" +
                        "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                            "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                "<i class='bi bi-question-diamond-fill me-1'></i>" +
                            "</div>" +
                            "{{ session('alerta_confirmar.texto') }}" +
                        "</span>" +
                    "</label>",
            footer: "<div class='d-flex gap-2'>" +
                        "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-danger btn-sm rounded focus-ring focus-ring-danger'>" +
                            "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                                "<div id='ok' class='cursor animate__animated animate__bounceOut animate__infinite'>" +
                                    "<i id='ok' class='cursor bi bi-x-circle-fill me-1'></i>" +
                                "</div>" +
                                "CANCELAR" +
                            "</span>" +
                        "</button>" +
                        "<form action='{{ route(session('alerta_confirmar.sim')) }}' method='POST'>" +
                            "<input type='hidden' name='_token' value='{{ csrf_token() }}'>" +
                            @if (session("alerta_confirmar.sim") == "deletar" || session("alerta_confirmar.sim") == "atualizar" || session("alerta_confirmar.sim") == "atualizar.senha")
                                "<input type='hidden' name='_method' value='{{ session('alerta_confirmar.sim') == 'atualizar' || session('alerta_confirmar.sim') == 'atualizar.senha' ? 'PUT' : 'DELETE' }}'>" +
                            @endif
                            "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' type='submit' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-success btn-sm rounded focus-ring focus-ring-success'>" +
                                "<span style='color: {{ $temas[2] }}' class='cursor d-flex justify-content-center'>" +
                                    "<div class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                        "<i class='cursor bi bi-check-circle-fill me-1'></i>" +
                                    "</div>" +
                                    "SIM" +
                                "</span>" +
                            "</button>" +
                        "</form>" +
                    "</div>",
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            },
            backdrop: `
                rgba(0, 0, 0, 0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
        });
    </script>
@endif

@if(session("alerta_resultado"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ $temas[0] }}",
            imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'>" +
                        "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                            "{{ session('alerta_resultado.titulo') }}" +
                        "</span>" +
                        "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                            "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                "<i class='cursor bi {{ session('alerta_resultado.icone') }} me-1'></i>" +
                            "</div>" +
                            "{{ session('alerta_resultado.texto') }}" +
                        "</span>" +
                    "</label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                        "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                            "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                            "</div>" +
                            "OK" +
                        "</span>" +
                    "</button>",
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            },
            backdrop: `
                rgba(0, 0, 0, 0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
        });
    </script>
@endif

@if(session("alerta_batalha"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ $temas[0] }}",
            imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'>" +
                        "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                            "{{ session('alerta_batalha.titulo') }}" +
                        "</span>" +
                        "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                            "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                "<i class='bi {{ session('alerta_batalha.icone') }} me-1'></i>" +
                            "</div>" +
                            "{{ session('alerta_batalha.texto') }}" +
                        "</span>" +
                    "</label>",
            footer: @if (session("alerta_batalha.rota") == "")
                        "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                    @else
                        "<a href='{{ session('alerta_batalha.rota') }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                    @endif
                         "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                            "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                            "</div>" +
                            "OK" +
                        "</span>" +
                    @if (session("alerta_batalha.rota") == "")
                        "</button>",
                    @else
                        "</a>",
                    @endif
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            },
            backdrop: `
                rgba(0, 0, 0, 0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
        });
    </script>
@endif

@if(session("alerta_nivel"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ $temas[0] }}",
            imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'>" +
                        "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                            "{{ session('alerta_nivel.titulo') }}" +
                        "</span>" +
                        "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                            "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                "<i class='bi bi-arrow-up-square-fill me-1'></i>" +
                            "</div>" +    
                            "{{ session('alerta_nivel.texto') }}" +
                        "</span>" +
                    "</label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                        "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                            "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                            "</div>" +
                            "OK" +
                        "</span>" +
                    "</button>",
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },
            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            },
            backdrop: `
                rgba(0, 0, 0, 0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
        });
    </script>
@endif

<script>
    function checkOrientation() {
        if (window.innerHeight > window.innerWidth) {
            Swal.fire({
                position: "center",
                draggable: true,
                showCloseButton: true,
                showConfirmButton: false,
                theme: "dark",
                background: "{{ $temas[0] }}",
                imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
                imageHeight: 150,
                customClass: {
                    image: "animate__animated animate__flipOutY animate__infinite"
                },
                title: "<label class='d-grid gap-3 py-2'>" +
                            "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                                "Virar Dispositivo!" +
                            "</span>" +
                            "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                                "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                    "<i class='cursor bi {{ session('alerta_resultado.icone') }} me-1'></i>" +
                                "</div>" +
                                "Por favor, para uma melhor esperiência, vira a tela do seu dispositivo." +
                            "</span>" +
                        "</label>",
                footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                            "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                                "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                    "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                                "</div>" +
                                "OK" +
                            "</span>" +
                        "</button>",
                showClass: {
                    popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                    `
                },
                hideClass: {
                    popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                    `
                },
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `,
            });
        }
    }
</script>