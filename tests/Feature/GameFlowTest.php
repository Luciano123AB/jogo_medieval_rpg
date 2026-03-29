<?php
 
use App\Models\Batalha;
use App\Models\Desafio;
use App\Models\Personagem;
use App\Models\Player;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
 
uses(RefreshDatabase::class);

function criarSkillParaTeste(array $overrides = []): Skill {

    $skill = new Skill();

    $skill->skill = $overrides['skill'] ?? 'Skill_' . fake()->unique()->numberBetween(1000, 9999);
    $skill->dano01 = $overrides['dano01'] ?? 100;
    $skill->dano02 = $overrides['dano02'] ?? 140;
    $skill->dano03 = $overrides['dano03'] ?? 220;
    $skill->save();

    return $skill;
}

function criarPersonagemParaTeste(array $overrides = []): Personagem {

    $skill01 = $overrides['skill01'] ?? criarSkillParaTeste(['skill' => 'Golpe_' . fake()->unique()->numberBetween(100, 999)]);
    $skill02 = $overrides['skill02'] ?? criarSkillParaTeste(['skill' => 'Combo_' . fake()->unique()->numberBetween(100, 999)]);
    $skill03 = $overrides['skill03'] ?? criarSkillParaTeste(['skill' => 'Ultimate_' . fake()->unique()->numberBetween(100, 999)]);
    $personagem = new Personagem();
 
    $personagem->classe = $overrides['classe'] ?? 'Classe_' . fake()->unique()->numberBetween(1000, 9999);
    $personagem->imagem = $overrides['imagem'] ?? 'img_' . fake()->unique()->numberBetween(1000, 9999) . '.png';
    $personagem->descricao = $overrides['descricao'] ?? fake()->unique()->sentence(8);
    $personagem->tipo_dano = $overrides['tipo_dano'] ?? 'Físico';
    $personagem->alcance = $overrides['alcance'] ?? 'Curto';
    $personagem->vida = $overrides['vida'] ?? 'Alta';
    $personagem->defesa = $overrides['defesa'] ?? 'Alta';
    $personagem->hp = $overrides['hp'] ?? 1200;
    $personagem->skill01_id = $skill01->id;
    $personagem->skill02_id = $skill02->id;
    $personagem->skill03_id = $skill03->id;
    $personagem->save();
 
    return $personagem;
}

function criarPlayerParaTeste(array $overrides = []): Player {

    $personagem = $overrides['personagem'] ?? criarPersonagemParaTeste();
    $player = new Player();

    $player->usuario = $overrides['usuario'] ?? 'player_' . fake()->unique()->userName();
    $player->email = $overrides['email'] ?? fake()->unique()->safeEmail();
    $player->senha = Hash::make($overrides['senha_plana'] ?? 'SenhaForte123');
    $player->genero = $overrides['genero'] ?? 'Masculino';
    $player->pais = $overrides['pais'] ?? 'BR';
    $player->foto = $overrides['foto'] ?? 'fotos/vazio.png';
    $player->nivel = $overrides['nivel'] ?? 1;
    $player->xp = $overrides['xp'] ?? 0;
    $player->quantidade_vitorias = $overrides['quantidade_vitorias'] ?? 0;
    $player->quantidade_derrotas = $overrides['quantidade_derrotas'] ?? 0;
    $player->personagem_id = $personagem->id;
    $player->save();
 
    return $player;
}

function criarBatalhaParaTeste(array $overrides = []): Batalha
{

    $batalha = new Batalha();

    $batalha->inicio = $overrides['inicio'] ?? false;
    $batalha->nome = $overrides['nome'] ?? 'PlayerTeste';
    $batalha->skill01 = $overrides['skill01'] ?? true;
    $batalha->skill02 = $overrides['skill02'] ?? true;
    $batalha->skill03 = $overrides['skill03'] ?? true;
    $batalha->nome_oponente = $overrides['nome_oponente'] ?? 'Computador';
    $batalha->skill01_oponente = $overrides['skill01_oponente'] ?? true;
    $batalha->skill02_oponente = $overrides['skill02_oponente'] ?? true;
    $batalha->skill03_oponente = $overrides['skill03_oponente'] ?? true;
    $batalha->hp_maximo = $overrides['hp_maximo'] ?? 1200;
    $batalha->hp = $overrides['hp'] ?? 1200;
    $batalha->hp_maximo_oponente = $overrides['hp_maximo_oponente'] ?? 1200;
    $batalha->hp_oponente = $overrides['hp_oponente'] ?? 1200;
    $batalha->vez = $overrides['vez'] ?? 0;
    $batalha->ganhou = $overrides['ganhou'] ?? null;
    $batalha->perdeu = $overrides['perdeu'] ?? null;
    $batalha->save();

    return $batalha;
}

test('home responde com sucesso para visitante', function () {

    $response = $this->get('/');
 
    $response->assertOk();
});

test('visitante sem login nao acessa atualizacao', function () {

    $response = $this->get('/atualizacao');
 
    $response->assertRedirect();
});

test('login autentica player com credenciais validas', function () {

    $senha = 'SenhaForte123';
    $player = criarPlayerParaTeste([
        'email' => 'login_teste@example.com',
        'senha_plana' => $senha
    ]);
    $response = $this->post('/logar', [
        'email' => $player->email,
        'senha' => $senha
    ]);
 
    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($player);
});

test('login falha com senha invalida', function () {
    $player = criarPlayerParaTeste([
        'email' => 'erro_login@example.com',
        'senha_plana' => 'SenhaForte123',
    ]);

    $response = $this->from('/')
        ->post('/logar', [
            'email' => $player->email,
            'senha' => 'SenhaErrada999',
        ]);

    $response->assertRedirect('/');
    $response->assertSessionHasErrors(['playerNaoExiste']);
    $this->assertGuest();
});
 
test('rota atualizar_tempo exige batalha em andamento', function () {

    $player = criarPlayerParaTeste();
    $response = $this->actingAs($player)
        ->postJson('/atualizar_tempo', [
            'minutos' => 0,
            'segundos' => 10
        ]);

    $response->assertRedirect(route('preparacao'));
});

test('atualizar_tempo retorna erro de validacao para segundos acima do limite', function () {

    $player = criarPlayerParaTeste();
    $response = $this->actingAs($player)
        ->withSession([
            'dados' => [
                'batalha_comecou' => true,
                'id_batalha' => 42
            ],
            'batalha_comecou' => true,
            'id_batalha' => 42
        ])
        ->post('/atualizar_tempo', [
            'minutos' => 1,
            'segundos' => 61
        ]);
 
     $response->assertSessionHasErrors(['segundos']);
});
 
test('atualizar_tempo salva cache e retorna ok quando payload e valido', function () {

    $player = criarPlayerParaTeste();
    $response = $this->actingAs($player)
        ->withSession([
            'id_batalha' => 99,
            'batalha_comecou' => true
        ])
        ->postJson('/atualizar_tempo', [
            'minutos' => 2,
            'segundos' => 30
        ]);

    $response->assertOk()->assertJson(['ok' => true]);

    expect(Cache::get('batalha_tempo_99'))->toBe([
        'minutos' => 2,
        'segundos' => 30
    ]);
});

test('logout encerra sessao do usuario', function () {

    $player = criarPlayerParaTeste();
    $response = $this->actingAs($player)
        ->post('/sair');

    $response->assertRedirect(route('home'));
    $this->assertGuest();
});

test('confirmar batalha exige oponente valido', function () {

    $player = criarPlayerParaTeste();
    $response = $this->actingAs($player)
        ->from(route('preparacao'))
        ->post('/confirmar_batalha', [
            'oponente' => 999999
        ]);

    $response->assertRedirect(route('preparacao'));
    $response->assertSessionHasErrors(['oponente']);
});

test('confirmar desafio bloqueia quando oponente tem nivel diferente', function () {

    $personagem = criarPersonagemParaTeste();
    $desafiante = criarPlayerParaTeste([
        'personagem' => $personagem,
        'nivel' => 1
    ]);
    $oponente = criarPlayerParaTeste([
        'personagem' => $personagem,
        'nivel' => 5
    ]);
    $response = $this->actingAs($desafiante)
        ->post('/confirmar_desafio/' . Crypt::encrypt($oponente->id));

    $response->assertRedirect();
    $response->assertSessionHas('alerta_resultado');
});

test('batalhar cria batalha e registra sessao quando ainda nao existe combate', function () {
    
    $personagemPlayer = criarPersonagemParaTeste(['classe' => 'Classe_A']);
    $personagemOponente = criarPersonagemParaTeste(['classe' => 'Classe_B']);
    $player = criarPlayerParaTeste(['personagem' => $personagemPlayer]);
    $response = $this->actingAs($player)
        ->withSession([
            'id_oponente' => $personagemOponente->id
        ])
        ->get('/batalha');

    $response->assertOk();
    $response->assertSessionHas('id_batalha');
    $response->assertSessionHas('batalha_comecou', true);

    expect(Batalha::query()->count())->toBe(1);
    expect(Desafio::query()->count())->toBe(1);
});

test('resetar vitorias remove registros do jogador autenticado', function () {

    $player = criarPlayerParaTeste(['usuario' => 'JogadorVitorioso']);
    $batalha = criarBatalhaParaTeste([
        'nome' => 'JogadorVitorioso',
        'ganhou' => 'JogadorVitorioso',
        'perdeu' => 'Computador'
    ]);

    $batalha->delete();

    $this->actingAs($player)
        ->delete('/resetar/vitorias')
        ->assertRedirect();

    expect(Batalha::withTrashed()->where('ganhou', 'JogadorVitorioso')->count())->toBe(0);
});