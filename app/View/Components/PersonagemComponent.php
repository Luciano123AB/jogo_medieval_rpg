<?php

namespace App\View\Components;

use App\Models\Personagem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PersonagemComponent extends Component
{
    public Personagem $personagem;
    public $temas;

    /**
     * Create a new component instance.
     */
    public function __construct(Personagem $personagem, $temas)
    {
        $this->personagem = $personagem;
        $this->temas = $temas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.personagem-component');
    }
}
