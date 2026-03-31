<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LimparFotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:limpar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exclui fotos temporárias antigas.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $path = public_path('temp_photos');
        $arquivos = scandir($path);

        foreach ($arquivos as $arquivo) {
            if ($arquivo === '.' || $arquivo === '..') {
                continue;
            }

            $caminhoCompleto = $path . '/' . $arquivo;
            $tempoLimite = 3600;

            if (filemtime($caminhoCompleto) < now()->timestamp - $tempoLimite) {
                unlink($caminhoCompleto);
            }
        }

        return 0;
    }
}
