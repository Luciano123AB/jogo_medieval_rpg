<?php

use App\Models\Personagem;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

function criarPlayerParaTeste(array $overrides = []): Player
{
    $personagem = new Personagem();
    $personagem->classe = $overrides['classe'] ?? 'C' . fake()->unique()->numberBetween(100, 999);
    $personagem->imagem = $overrides['imagem'] ?? 'img' . fake()->unique()->numberBetween(100, 999);
    $personagem->descricao = $overrides['descricao'] ?? fake()->unique()->sentence(5);
    $personagem->tipo_dano = $overrides['tipo_dano'] ?? 'Fisico';
    $personagem->alcance = $overrides['alcance'] ?? 'Curto';
    $personagem->vida = $overrides['vida'] ?? 'Alta';
    $personagem->defesa = $overrides['defesa'] ?? 'Alta';
    $personagem->hp = $overrides['hp'] ?? 1000;
    $personagem->save();

    $player = new Player();
    $player->usuario = $overrides['usuario'] ?? 'player_' . fake()->unique()->userName();
    $player->email = $overrides['email'] ?? fake()->unique()->safeEmail();
    $player->senha = Hash::make($overrides['senha_plana'] ?? 'SenhaForte123');
    $player->genero = $overrides['genero'] ?? 'Masculino';
    $player->pais = $overrides['pais'] ?? 'BR';
    $player->foto = $overrides['foto'] ?? 'nenhuma';
    $player->nivel = $overrides['nivel'] ?? 1;
    $player->xp = $overrides['xp'] ?? 0;
    $player->quantidade_vitorias = $overrides['quantidade_vitorias'] ?? 0;
    $player->quantidade_derrotas = $overrides['quantidade_derrotas'] ?? 0;
    $player->personagem_id = $personagem->id;
    $player->save();

    return $player;
}

test('visitante sem login nao acessa atualizacao', function () {
    $response = $this->get('/atualizacao');

    $response->assertRedirect();
});

test('login autentica player com credenciais validas', function () {
    $senha = 'SenhaForte123';
    $player = criarPlayerParaTeste([
        'email' => 'login_teste@example.com',
        'senha_plana' => $senha,
    ]);

    $response = $this->post('/logar', [
        'email' => $player->email,
        'senha' => $senha,
    ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($player);
});

test('atualizar_tempo retorna erro de validacao para segundos acima de 60', function () {
    $player = criarPlayerParaTeste();

    $response = $this->actingAs($player)
        ->withSession([
            'dados' => [
                'batalha_comecou' => true,
                'id_batalha' => 42,
            ],
        ])
        ->post('/atualizar_tempo', [
            'minutos' => 1,
            'segundos' => 61,
        ]);

    $response->assertSessionHasErrors(['segundos']);
});

test('atualizar_tempo salva cache e retorna ok quando payload e valido', function () {
    $player = criarPlayerParaTeste();

    $response = $this->actingAs($player)
        ->withSession([
            'dados' => [
                'batalha_comecou' => true,
                'id_batalha' => 99,
            ],
        ])
        ->postJson('/atualizar_tempo', [
            'minutos' => 2,
            'segundos' => 30,
        ]);

    $response->assertOk()->assertJson(['ok' => true]);

    expect(Cache::get('batalha_tempo_99'))->toBe([
        'minutos' => 2,
        'segundos' => 30,
    ]);
});