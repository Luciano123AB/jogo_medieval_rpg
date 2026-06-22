const {
    mensagem_tabela,
    tema_background,
    tema
} = window.gameData;

let table = new DataTable('#tabela', {
    pageLength: 10,
    responsive: true,
    lengthMenu: [5, 10, 20, 40, 80],
    language: {
        emptyTable: 'NENHUMA BATALHA ' + mensagem_tabela
    },
    dom:
        '<"row mb-3 align-items-center"<"col-md-6"f><"col-md-6 text-end"l>>' +
        't' +
        '<"row mt-3 align-items-center"<"col-md-6"i><"col-md-6"p>>'
});

let table02 = new DataTable('#tabela02', {
    pageLength: 10,
    responsive: true,
    lengthMenu: [5, 10, 20, 40, 80],
    language: {
        emptyTable: 'NENHUMA BATALHA ' + mensagem_tabela
    },
    dom:
        '<"row mb-3 align-items-center"<"col-md-6"f><"col-md-6 text-end"l>>' +
        't' +
        '<"row mt-3 align-items-center"<"col-md-6"i><"col-md-6"p>>'
});

$('.dt-search input').addClass(
    'cursor bg-' + tema_background + ' border-' + tema + ' focus-ring focus-ring-' + tema + ' mt-1'
);
$('.dt-length select').addClass(
    'cursor bg-' + tema_background + ' border-' + tema + ' focus-ring focus-ring-' + tema
);