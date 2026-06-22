document.addEventListener('DOMContentLoaded', () => {

    const audio = document.getElementById('trilha_sonora');
    const icone = document.getElementById('icone_musica');
    let tocando = sessionStorage.getItem('musica_tocando') === 'true';
    let tempo_salvo = sessionStorage.getItem('musica_tempo');

    function atualizarIcone(tocando) {
        if (tocando) {
            icone.classList.remove('bi-volume-mute-fill');
            icone.classList.add('bi-volume-up-fill');
        } else {
            icone.classList.remove('bi-volume-up-fill');
            icone.classList.add('bi-volume-mute-fill');
        }
    }

    if (tempo_salvo) {
        audio.currentTime = parseFloat(tempo_salvo);
    }

    if (tocando) {
        audio.play().catch(() => {});
        icone.classList.replace('bi-volume-up-fill', 'bi-volume-mute-fill');
    }

    document.getElementById('botao_musica').addEventListener('click', () => {
        tocando = !tocando;

        if (tocando) {
            audio.play();
        } else {
            audio.pause();
        }

        sessionStorage.setItem('musica_tocando', tocando);
        atualizarIcone(tocando);
    });

    atualizarIcone(tocando);

    const trilhaEstavaTocando = tocando && !audio.paused;

    window.addEventListener('beforeunload', () => {
        sessionStorage.setItem('musica_tempo', audio.currentTime);
    });
});