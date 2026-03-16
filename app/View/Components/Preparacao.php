<?php

namespace App\View\Components;

use App\Models\Personagem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Preparacao extends Component
{
    public Personagem $personagem;
    public $nivel;
    public $temas;
    
    /**
     * Create a new component instance.
     */
    public function __construct(Personagem $personagem, $nivel, $temas)
    {
        $this->personagem = $personagem;
        $this->nivel = $nivel;
        $this->temas = $temas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.preparacao');
    }
}
