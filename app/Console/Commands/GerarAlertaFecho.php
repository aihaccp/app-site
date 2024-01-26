<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\RegistoAberturaFecho;
use App\Models\Alerta;
use DateTime;
use Livewire\Livewire;

class GerarAlertaFecho extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerta:fecho {--company=}';

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
        $empresa = Company::where('id', $empresaId)->first();
        $registo = RegistoAberturaFecho::where('id_empresa', $empresaId)->where('tipo_abertura_fecho', 1)->orderBy('created_at','desc')->first();

        if(isset($registo)){
            $timestampDate = new DateTime(date($registo->created_at));
            $currentDate = new DateTime(date('Y-m-d').' '.$empresa->abertura);

            if($timestampDate <= $currentDate){
                $alerta = new Alerta;
                $alerta->id_empresa = $empresaId;
                $alerta->mensagem = "Lembrete para fazer a verificação de fecho";
                $alerta->tipo = 1;
                $alerta->save();
            }
        }else{
            $alerta = new Alerta;
            $alerta->id_empresa = $empresaId;
            $alerta->mensagem = "Lembrete para fazer a verificação de fecho";
            $alerta->tipo = 1;
            $alerta->save();
        }
    }
}
