<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RegistoAberturaFecho;
use App\Models\Alerta;

class GerarAlertaAbertura extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerta:abertura {--company=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $empresaId = $this->option('company');
        $registo = RegistoAberturaFecho::where('id_empresa', $empresaId)->where('tipo_abertura_fecho', 0)->orderBy('created_at','desc')->first();
        echo $registo;
        if(isset($registo)){
            echo "Enytrou/n";
            $timestampDate = date('Y-m-d', strtotime($registo->created_at));
echo $timestampDate.'/n';
            $currentDate = date('Y-m-d');
echo $currentDate.'/n';
            if($timestampDate !== $currentDate){
                $alerta = new Alerta;
                $alerta->id_empresa = $empresaId;
                $alerta->mensagem = "Lembrete para fazer a verificação de abertura";
                $alerta->tipo = 0;
                $alerta->save();
                echo "Entrou";
            }
        }else{
            $alerta = new Alerta;
            $alerta->id_empresa = $empresaId;
            $alerta->mensagem = "Lembrete para fazer a verificação de abertura";
            $alerta->tipo = 0;
            $alerta->save();
        }
    }
}
