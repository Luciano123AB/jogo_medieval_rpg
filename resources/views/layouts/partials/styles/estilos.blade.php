<style>
    * {
        cursor: url("/assets/images/cursores/cursor.png"), auto;
    }

    .cursor:hover {
        cursor: url("/assets/images/cursores/cursor_batalha.png"), auto;
    }

    .ripple-rpg {
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        transform: scale(0);
        pointer-events: none;
        z-index: 9999;

        background: radial-gradient(circle, #e5a350, orange, transparent);
        animation: ripple-rpg 700ms ease-out;
    }

    @keyframes ripple-rpg {
        to {
            transform: scale(6);
            opacity: 0;
        }
    }

    .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: #e5a350;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        animation: particle 700ms ease-out forwards;
    }

    @keyframes particle {
        to {
            transform: translate(var(--x), var(--y));
            opacity: 0;
        }
    }

    #fundo {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100%;
        background-image: url('{{ asset('assets/images/fundos/' . (session('tema') == 'escuro' ? "$imagem" . '.png' : "$imagem" . '_noite.png')) }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        z-index: -1;
        transition: transform 0.1s ease-out;
    }

    .gifs {
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

    .subnavbar {
        height: 50%;
    }
    
    .sombras {
        box-shadow: 5px 5px 5px 0 rgba(36, 40, 43);
    }

    .fundos_card_claro {
        background-color: rgba(0, 0, 0, 0.3);
    }
    
    .fundos_card_escuro {
        background-color: rgba(127, 127, 127, 0.3);        
    }

    #espacamento {
        margin-bottom: 22%;
    }

    #index_opcoes {
        width: 75%;
    }
    
    #direitos {
        width: 40px;
        text-decoration: underline;
    }

    .icones {
        width: 40px;
        height: 40px;
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

    #paises {
        display:none;
        max-height:200px;
        overflow-y:auto;
    }

    .perfil_cadastro {
        width: 100px;
        height: 100px;
    }

    .horizontal_vertical {
        display: flex;
    }

    #lista_bandeiras {
        width: 33%;
    }

    .perfil_player {
        width: 50px;
        height: 50px;
    }

    .bandeiras {
        height: 18px;
    }

    #total_players {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
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

    #oponentes {
        width: 33%;
    }

    #login {
        width: 300px;
    }    

    .barras {
        height: 20px;
    }

    .magias {
        z-index: 9999;
        pointer-events: none;
        transform: translate(-50%, -50%);
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

    @media(width <= 430px) {
        #index_opcoes {
            width: 100%;
        }

        .horizontal_vertical {
            display: grid;
            grid-template-columns: 1fr;
        }

        #lista_bandeiras {
            width: 100%;
        }

        #total_players {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>