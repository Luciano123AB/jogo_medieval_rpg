<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtualizarTempo;
use App\Models\Batalha;
use App\Models\Personagem;
use App\Models\Player;
use App\Services\Randoms;
use App\Services\Salvar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Batalhar extends Controller
{
    public function confirmarBatalha(Request $request): RedirectResponse {
        $request->validate(
            [
                'oponente' => 'required|exists:personagems,id'
            ],

            [
                'oponente.required' => 'Você deve escolher o seu oponente primeiro.'
            ]
        );

        $this->alertaConfirmar('Confirmar Batalha!', 'Tem certeza que está pronto para ir para a batalha?', 'batalhar.iniciar');
        session(['id_oponente_temporario' => $request->oponente]);

        return redirect()->back()->withInput();
    }

    public function confirmarDesafio($id): RedirectResponse {

        $dados_oponente = Player::find(Crypt::decrypt($id));

        if (!$dados_oponente) {
            $this->alertaResultado('Erro ao Carregar Dados!', 'Ocorreu um erro ao tentar carregar os dados do player! Tente novamente.', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        }

        if ($dados_oponente->nivel > Auth::user()->nivel) {
            $this->alertaResultado('Player Muito Forte!', 'Você não pode desafiar um player de nível superior que o seu. Escolha outro.', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        } elseif ($dados_oponente->nivel < Auth::user()->nivel) {
            $this->alertaResultado('Player Muito Fraco!', 'Você não pode desafiar um player de nível inferior que o seu. Escolha outro.', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        }
        
        $this->alertaConfirmar('Confirmar Desafio!', 'Tem certeza que deseja desafiar este player?', 'batalhar.iniciar');
        session([
            'id_player_temporario' => $dados_oponente->id,
            'id_oponente_temporario' => $dados_oponente->personagem->id
        ]);

        return redirect()->back();
    }

    public function iniciarBatalha(): RedirectResponse {
        session(['id_oponente' => session('id_oponente_temporario')]);

        if (session()->has('id_player_temporario')) {
            session(['id_player' => session('id_player_temporario')]);
        }

        return redirect()->route('batalhar');
    }

    public function atacar(Request $request): JsonResponse | RedirectResponse {

        $skill_escolhida = $request->input('btnradio');

        if (!$skill_escolhida) {
            return response()->json([
                'success' => false
            ]);
        }

        $batalha = Batalha::find(session('id_batalha'));
        $dano = Randoms::danoPlayerSorteado($batalha, Personagem::findOrFail(Auth::user()->personagem->id), Auth::user()->nivel, $skill_escolhida);

        if (!Salvar::atacar(Batalha::findOrFail(session('id_batalha')), $dano)) {
            $this->alertaResultado('Erro ao Atacar!', 'Ocorreu um erro ao tentar atacar o oponente! Tente novamente.', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        }

        $batalha->refresh();

        return response()->json([
            'classe' => Auth::user()->personagem->classe,
            'dano' => $dano,
            'hp_player' => $batalha->hp,
            'hp_oponente' => $batalha->hp_oponente,
            'skill01' => $batalha->skill01,
            'skill02' => $batalha->skill02,
            'skill03' => $batalha->skill03,
            'vez' => $batalha->vez,
            'success' => true
        ]);
    }

    public function ataqueOponente($id): JsonResponse | RedirectResponse {
        if (session()->has('nivel_oponente')) {

            $nivel = session('nivel_oponente');

        } else {

            $nivel = Auth::user()->nivel;

        }
              
        $batalha = Batalha::find(session('id_batalha'));
        $resultado = Randoms::danoOponenteSorteado(Batalha::find(session('id_batalha')), Personagem::findOrFail($id), $nivel);

        if (!Salvar::ataqueOponente(Batalha::findOrFail(session('id_batalha')), $resultado['dano'])) {
            $this->alertaResultado('Erro ao Receber Ataque!', 'Ocorreu um erro ao receber o ataque do oponente!', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        }

        $batalha->refresh();

        return response()->json([
            'classe' => Personagem::findOrFail($id)->classe,
            'dano' => $resultado['dano'],
            'tipo_ataque' => $resultado['tipo_ataque'],
            'hp_player' => $batalha->hp,
            'hp_oponente' => $batalha->hp_oponente,
            'skill01' => $batalha->skill01,
            'skill02' => $batalha->skill02,
            'skill03' => $batalha->skill03,
            'vez' => $batalha->vez,
            'success' => true
        ]);
    }

    public function confirmarRender(): RedirectResponse {
        $this->alertaConfirmar('Confirmar Rendição!', 'Tem certeza que deseja desistir dessa batalha?', 'renderSe');

        return redirect()->back();
    }

    public function atualizarTempo(AtualizarTempo $request): JsonResponse {
        Cache::put(
            'batalha_tempo_' . session('id_batalha'),
            $request->validated(),
            now()->addMinutes(30)
        );

        return response()->json(['ok' => true]);
    }

    public function renderSe(): RedirectResponse {

        $batalha = Batalha::findOrFail(session('id_batalha'));
        $nome_oponente = $batalha->nome_oponente;

        if (!Salvar::render(Player::findOrFail(Auth::user()->id), $batalha)) {
            $this->alertaResultado('Erro ao Render-se!', 'Ocorreu um erro ao tentar se render! Tente novamente.', 'bi-hand-thumbs-down-fill');

            return redirect()->back();
        }

        session()->forget([
            'id_batalha',
            'batalha_comecou'
        ]);
        session()->flash('derrota', true);
        $this->alertaBatalha('Derrota!', 'Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.', 'bi-emoji-frown-fill', '');

        if ($nome_oponente == 'Computador') {
            return redirect()->route('preparacao');
        }
        
        return redirect()->route('listagem');
    }
}