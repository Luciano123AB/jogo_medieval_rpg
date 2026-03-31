<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Totais extends Component
{
    
    public $dados;
    public $codigo;
    public $temas;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $dados,
        $codigo,
        $temas
    )
    {
        $this->dados = $dados;
        $this->codigo = $codigo;
        $this->temas = $temas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.totais');
    }
}
