<?php

namespace App\Console\Commands;

use App\Models\Desafio;
use Illuminate\Console\Command;

class ResetarDesafios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resetar-desafios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resetar todos os desafios para permitir novos desafios diariamente.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Desafio::truncate();

        $this->info('Todos os desafios foram resetados!');
    }
}
