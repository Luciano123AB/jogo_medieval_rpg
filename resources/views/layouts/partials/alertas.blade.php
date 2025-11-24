@php

    $alerta = session("alerta");
    $pagina = $alerta["pagina"] ?? null;
    $chaveLancado = "alerta_{$pagina}_lancado";
    $icone = "";

    if (session("alerta.icone") == "⚔️") {
        $icone = "⚔️";
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
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='cursor bi {{ session('alerta.icone') }}'></i>{{ $icone }} {{ session('alerta.texto') }}</span></label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn {{ session('tema') == 'escuro' ? 'btn-secondary focus-ring focus-ring-primary' : 'btn-danger focus-ring focus-ring-danger' }} btn-sm rounded-pill'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' id='ok' class='cursor'> OK</span></button>",
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
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta_confirmar.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='bi bi-question-diamond-fill'></i> {{ session('alerta_confirmar.texto') }}</span></label>",
            footer: "<div class='d-flex gap-2'><a href='{{ route(session('alerta_confirmar.cancelar')) }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-danger btn-sm rounded focus-ring focus-ring-danger'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor bi bi-x-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' class='cursor'> CANCELAR</span></a><a href='{{ route(session('alerta_confirmar.sim')) }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-success btn-sm rounded focus-ring focus-ring-success'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' class='cursor'> SIM</span></a></div>",
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

@if(session("alerta_confirmar_render"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta_confirmar_render.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='bi bi-question-diamond-fill'></i> {{ session('alerta_confirmar_render.texto') }}</span></label>",
            footer: "<div class='d-flex gap-2'><a href='{{ route(session('alerta_confirmar_render.cancelar')) }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-danger btn-sm rounded focus-ring focus-ring-danger'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor bi bi-x-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' class='cursor'> CANCELAR</span></a><a href='{{ route(session('alerta_confirmar_render.sim')) }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor sombras botoes animate__animated animate__fadeIn btn btn-success btn-sm rounded focus-ring focus-ring-success'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' class='cursor'> SIM</span></a></div>",
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

@if(session("alerta_operacao"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta_operacao.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='cursor bi bi-hand-thumbs-up-fill'></i> {{ session('alerta_operacao.texto') }}</span></label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn {{ session('tema') == 'escuro' ? 'btn-secondary focus-ring focus-ring-primary' : 'btn-danger focus-ring focus-ring-danger' }} btn-sm rounded-pill'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' id='ok' class='cursor'> OK</span></button>",
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
    
    {{ session()->forget("alerta_operacao") }}
@endif

@if(session("alerta_resultado"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta_resultado.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='bi {{ session('alerta_resultado.icone') }}'></i> {{ session('alerta_resultado.texto') }}</span></label>",
            footer: "<a href='{{ session('alerta_resultado.rota') }}' style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor sombras botoes animate__animated animate__fadeIn btn {{ session('tema') == 'escuro' ? 'btn-secondary focus-ring focus-ring-primary' : 'btn-danger focus-ring focus-ring-danger' }} btn-sm rounded-pill'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' class='cursor'> OK</span></a>",
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
    
    {{ session()->forget("alerta_resultado") }}
@endif

@if(session("alerta_nivel"))
    <script>
        Swal.fire({
            position: "center",
            draggable: true,
            showCloseButton: true,
            showConfirmButton: false,
            theme: "dark",
            background: "{{ session('tema') == 'escuro' ? '#f8f9fa' : '#323232' }}",
            imageUrl: "{{ asset('assets/images/icone.png') }}",
            imageHeight: 150,
            customClass: {
                image: "animate__animated animate__flipOutY animate__infinite"
            },
            title: "<label class='d-grid gap-3 py-2'><span class='{{ session('tema') == 'escuro' ? 'titulos_escuro cor_fontes_escuro border-primary' : 'titulos_claro cor_fontes_claro border-danger' }} border-top border-bottom py-3'>{{ session('alerta_nivel.titulo') }}</span><span class='{{ session('tema') == 'escuro' ? 'cor_fontes_escuro' : 'cor_fontes_claro' }} fs-5'><i class='bi bi-arrow-up-square-fill'></i> {{ session('alerta_nivel.texto') }}</span></label>",
            footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn {{ session('tema') == 'escuro' ? 'btn-secondary focus-ring focus-ring-primary' : 'btn-danger focus-ring focus-ring-danger' }} btn-sm rounded-pill'><i style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }};' id='ok' class='cursor bi bi-check-circle-fill'></i><span style='color: {{ session('tema') == 'escuro' ? '#493722' : '#e5a350' }}' id='ok' class='cursor'> OK</span></button>",
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
    
    {{ session()->forget("alerta_nivel") }}
@endif