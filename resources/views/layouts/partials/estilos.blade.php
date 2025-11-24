<style>
    * {
        cursor: url("/assets/images/cursores/cursor.png"), auto;
    }

    .cursor:hover {
        cursor: url("/assets/images/cursores/cursor_batalha.png"), auto;
    }

    #fundo {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-image: url('{{ asset('assets/images/fundos/' . (session('tema') === 'escuro' ? "$imagem" . '.png' : "$imagem" . '_noite.png')) }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        z-index: -1;
        transition: transform 0.1s ease-out;
    }

    #fogo {
        z-index: -1;
    }

    #navbar {
        box-shadow: 0 20px 20px 0;
        border-style: double;
    }

    #icone {
        width: 70px;
    }

    .cor_fontes_claro {
        color: #e5a350;
    }

    .cor_fontes_escuro {
        color: #493722;
    }    

    .titulos_claro {
        text-decoration: underline;
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: #8d7752;
    }
    
    .titulos_escuro {
        text-decoration: underline;
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: #64553a;
    }
    
    .botoes {
        transition: transform 0.3s ease;
    }

    .botoes:hover {
        transform: scale(1.1);
    }
    
    .sombras {
        box-shadow: 5px 5px 5px 0 rgba(36, 40, 43);
    }
    
    .fundos_card_escuro {
        background-color: rgba(0, 0, 0, 0.3);
    }

    .fundos_card_claro {
        background-color: rgba(127, 127, 127, 0.3);
    }
    
    #direitos {
        width: 40px;
        text-decoration: underline;
    }

    #icone_creditos {
        width: 30px;
    }

    .cards {
        transition: transform 0.3s ease;
    }

    .cards:hover {
        transform: scale(0.95);
    }

    .paragrafos {
        text-indent: 30px;
    }

    .perfil_cadastro {
        width: 100px;
        height: 100px;
    }

    #perfil_player {
        width: 50px;
        height: 50px;
    }

    .opcoes_player_claro:hover {
        background-color: #64553a;
    }

    .opcoes_player_escuro:hover {
        background-color: #8d7752;
    }

    .cor_niveis {
        color: #073c8b;
    }    

    #login {
        width: 300px;
    }

    .barras {
        height: 20px;
    }

    .perfil_players {
        width: 25px;
        height: 25px;
    }

    #desafiar {
        height: 63px;
    }

    .tabelas {
        height: 50vh;
    }

    .tabelas-scroll {
        max-height: 50vh;
        overflow-y: auto;
        overflow-x: auto;
    }
</style>