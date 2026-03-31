<?php

namespace App\View\Components;

use App\Models\Player;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class players extends Component
{

    public $player;
    public $temas;
    public $desafiou;
    public $loop;

    /**
     * Create a new component instance.
     */
    public function __construct(
        Player $player,
        $temas,
        $desafiou,
        $loop
    )
    {
        $this->player = $player;
        $this->temas = $temas;
        $this->desafiou = $desafiou;
        $this->loop = $loop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.players');
    }
}
