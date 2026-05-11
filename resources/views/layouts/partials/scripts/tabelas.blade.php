<script>
    @php

        $mensagem = "ACONTECENDO NO MOMENTO.";

        if ($pagina == "Registro") {
            $mensagem = "REGISTRADA AINDA.";
        }
    @endphp

    let table = new DataTable('#tabela', {
        pageLength: 10,
        responsive: true,
        lengthMenu: [5, 10, 20, 40, 80],
        language: {
            emptyTable: "NENHUMA BATALHA {{ $mensagem }}"
        },
        dom:
            "<'row mb-3 align-items-center'<'col-md-6'f><'col-md-6 text-end'l>>" +
            "t" +
            "<'row mt-3 align-items-center'<'col-md-6'i><'col-md-6'p>>"
    });

    let table02 = new DataTable('#tabela02', {
        pageLength: 10,
        responsive: true,
        lengthMenu: [5, 10, 20, 40, 80],
        language: {
            emptyTable: "NENHUMA BATALHA {{ $mensagem }}"
        },
        dom:
            "<'row mb-3 align-items-center'<'col-md-6'f><'col-md-6 text-end'l>>" +
            "t" +
            "<'row mt-3 align-items-center'<'col-md-6'i><'col-md-6'p>>"
    });

    @php

        $tema_bg = "light";

        if (session()->has("tema") && session("tema") == "claro") {
            $tema_bg = "dark";
        }
    @endphp

    $('.dt-search input').addClass(
        'cursor bg-{{ $tema_bg }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} mt-1'
    );
    $('.dt-length select').addClass(
        'cursor bg-{{ $tema_bg }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }}'
    );
</script>