<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Regras extends Component
{
    public $regra;
    public $temas;

    /**
     * Create a new component instance.
     */
    public function __construct($regra, $temas)
    {
        $this->regra = $regra;
        $this->temas = $temas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.regras');
    }
}
