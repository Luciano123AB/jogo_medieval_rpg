
const {    
    csrf,    
    hp_maximo_player,    
    hp_maximo_oponente,    
    img_player,
    img_player_ataque,
    aura_player,
    img_oponente,
    img_oponente_ataque,
    aura_oponente,
    rota_atacar,
    rota_ataque
} = window.gameData;
let {
    segundos,
    minutos,
    vez,
    hp_player,
    hp_oponente,
    skill01_disponivel,
    skill02_disponivel,
    skill03_disponivel
} = window.gameData;

function atualizar() {
    document.getElementById('segundos').innerText = String(segundos).padStart(2, '0');
    document.getElementById('minutos').innerText = minutos;

    segundos++;

    if (segundos == 60) {
        segundos = 0;
        minutos++
    }

    setTimeout(atualizar, 1000);
}

function salvar() {
    fetch('atualizar_tempo', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({ segundos, minutos })
    });
}

atualizar();

const tela_cheia = document.getElementById('tela_cheia');
const icone_tela = document.getElementById('icone_tela_cheia');

tela_cheia.addEventListener('click', function() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
        icone_tela.classList.remove('bi-arrows-angle-expand');
        icone_tela.classList.add('bi-arrows-angle-contract');
    } else {
        document.exitFullscreen();
        icone_tela.classList.remove('bi-arrows-angle-contract');
        icone_tela.classList.add('bi-arrows-angle-expand');
    }
});

window.addEventListener('resize', checkOrientation);
window.addEventListener('load', checkOrientation);

const skill01 = document.getElementById('btnradio1');
const skill02 = document.getElementById('btnradio2');
const skill03 = document.getElementById('btnradio3');

const atacar = document.getElementById('atacar');
const ataque = document.getElementById('ataque');

document.getElementById('hp').style.width = calcularPorcentagem(hp_player, hp_maximo_player) + '%';
document.getElementById('hp_oponente').style.width = calcularPorcentagem(hp_oponente, hp_maximo_oponente) + '%';

function calcularPorcentagem(atual, maximo) {
    return (atual / maximo) * 100;
}

const indicar_vez = document.getElementById('vez');
const cor_vez = document.querySelectorAll('.cor_vez');

function atualizarMomento() {

    const momento = document.getElementById('momento');

    if (
        calcularPorcentagem(hp_player, hp_maximo_player) <= 10 ||
        calcularPorcentagem(hp_oponente, hp_maximo_oponente) <= 10
    ) {
        momento.hidden = false;
    } else {
        momento.hidden = true;
    }
}

atualizarMomento();

let batalha_iniciada = false;

function atualizarTurnoUI() {

    const player = document.getElementById('player');
    const oponente = document.getElementById('oponente');

    if (vez == 0) {
        indicar_vez.textContent = 'Você';
        cor_vez.forEach(element => {
            element.classList.remove('text-danger');
            element.classList.add('text-success');
        });

        skill01.disabled = !skill01_disponivel;
        skill02.disabled = !skill02_disponivel;
        skill03.disabled = !skill03_disponivel;

        player.style.backgroundImage = 'url("")';
        oponente.style.backgroundImage = 'url(aura_oponente)';

        if (batalha_iniciada == false) {
            atacar.classList.remove('opacity-75');
            atacar.disabled = false;
        } else {
            batalha_iniciada = true;
            
            setTimeout(() => {
                atacar.classList.remove('opacity-75');
                atacar.disabled = false;
            }, 3000);
        }
    } else {
        indicar_vez.textContent = 'Oponente';
        cor_vez.forEach(element => {
            element.classList.remove('text-success');
            element.classList.add('text-danger');
        });
        atacar.classList.add('opacity-75');
        atacar.disabled = true;

        skill01.disabled = true;
        skill02.disabled = true;
        skill03.disabled = true;

        oponente.style.backgroundImage = 'url("")';
        player.style.backgroundImage = 'url(aura_player)';

        if (batalha_iniciada == false) {
            batalha_iniciada = true;
        }

        setTimeout(() => {
            ataque.click();
        }, 3500);
    }
}

atualizarTurnoUI();

const som_ataque = document.getElementById('som_ataque');

if (atacar) {
    atacar.addEventListener('click', function() {
        salvar();

        const skillSelecionada = document.querySelector('input[name="btnradio"]:checked');
        const radios = document.querySelectorAll('input[name="btnradio"]');
        const index = Array.from(radios).indexOf(skillSelecionada);

        if (!skillSelecionada) {
            document.getElementById('escolha').hidden = false;

            setTimeout(() => {
                document.getElementById('escolha').hidden = true;
            }, 3000);

            return;
        }

        fetch(rota_atacar, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({
                btnradio: skillSelecionada.value
            })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {

                const player = document.getElementById('player');
                const oponente = document.getElementById('oponente');

                hp_player = data.hp_player;
                hp_oponente = data.hp_oponente;

                player.src = img_player_ataque;

                setTimeout(() => {
                    player.src = img_player;
                    oponente.src = img_oponente;
                }, 3000);

                if (data.classe == 'Mago') {
                    magiaPlayer();
                }

                ataquePlayer(index);

                skillSelecionada.checked = false;

                som_ataque.currentTime = 0;
                som_ataque.play().catch(error => {
                    console.error('Erro ao reproduzir o áudio de ataque:', error);
                });

                document.getElementById('hp').style.width = calcularPorcentagem(data.hp_player, hp_maximo_player) + '%';
                document.getElementById('hp_oponente').style.width = calcularPorcentagem(data.hp_oponente, hp_maximo_oponente) + '%';
                document.getElementById('dano_player').textContent = '🎯 -' + data.dano;
                document.getElementById('dano_player').hidden = false;

                setTimeout(() => {
                    document.getElementById('dano_player').hidden = true;
                }, 3000);

                if (data.hp_oponente <= 0) {
                    window.location.reload();
                }

                skill01_disponivel = data.skill01;
                skill02_disponivel = data.skill02;
                skill03_disponivel = data.skill03;

                vez = data.vez;

                atualizarTurnoUI();
                atualizarMomento();
            } else {
                console.error('Erro ao processar o ataque:', data.message);
            }
        })
        .catch(error => {
            console.error('Erro na requisição de ataque:', error);
        });
    });
}

ataque.addEventListener('click', function() {
    salvar();

    fetch(rota_ataque, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({})
    }).then(response => response.json())
    .then(data => {
        if (data.success) {                

            const player = document.getElementById('player');
            const oponente = document.getElementById('oponente');

            hp_player = data.hp_player;
            hp_oponente = data.hp_oponente;

            oponente.src = img_oponente_ataque;

            setTimeout(() => {
                player.src = img_player;
                oponente.src = img_oponente;
            }, 3000);

            if (data.classe == 'Mago') {
                magiaOponente();
            }

            ataqueOponente(data.tipo_ataque);

            som_ataque.currentTime = 0;
            som_ataque.play().catch(error => {
                console.error('Erro ao reproduzir o áudio de ataque:', error);
            });

            document.getElementById('hp').style.width = calcularPorcentagem(data.hp_player, hp_maximo_player) + '%';
            document.getElementById('hp_oponente').style.width = calcularPorcentagem(data.hp_oponente, hp_maximo_oponente) + '%';
            document.getElementById('dano_oponente').textContent = '🎯 -' + data.dano;
            document.getElementById('dano_oponente').hidden = false;

            setTimeout(() => {
                document.getElementById('dano_oponente').hidden = true;
            }, 3000);

            if (data.hp_player <= 0) {
                window.location.reload();
            }

            skill01_disponivel = data.skill01;
            skill02_disponivel = data.skill02;
            skill03_disponivel = data.skill03;

            vez = data.vez;
            
            atualizarTurnoUI();
            atualizarMomento();
        } else {
            console.error('Erro ao processar o ataque do oponente:', data.message);
        }
    })
    .catch(error => {
        console.error('Erro na requisição de ataque do oponente:', error);
    });
});