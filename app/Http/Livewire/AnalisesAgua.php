<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use DB;
use Session;

class AnalisesAgua extends Component
{

    public $networkType = 'Publica'; // Valor padrão
    public $establishmentUuid;

    public function mount($establishmentUuid)
    {
        $this->establishmentUuid = Company::where('uuid', $establishmentUuid)->first()->id;

        $record = DB::table('analises_agua')
                    ->where('id_empresa', $this->establishmentUuid)
                    ->latest()
                    ->first();

        if ($record) {
            $this->networkType = $record->tipo;
        }
    }

    public function save()
    {
        // Verifica se já existe um registro com o UUID da empresa
        $existingRecord = DB::table('analises_agua')
                            ->where('id_empresa', $this->establishmentUuid)
                            ->first();

        if ($existingRecord) {
            // Se existir, atualiza o registro
            DB::table('analises_agua')
              ->where('id_empresa', $this->establishmentUuid)
              ->update([
                  'tipo' => $this->networkType
              ]);
        } else {
            // Se não existir, insere um novo registro
            DB::table('analises_agua')->insert([
                'id_empresa' => $this->establishmentUuid,
                'tipo' => $this->networkType
            ]);
        }

        // Configura uma mensagem de sucesso na sessão
        Session::flash('mensagem_sucesso', 'Dados salvos com sucesso!');
    }
    public function render()
    {
        return view('livewire.analises-agua');
    }
}
