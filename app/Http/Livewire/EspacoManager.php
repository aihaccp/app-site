<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EspacoManager extends Component
{
    public $isBlocked = false;
    public $espacos = [];
    public $establishmentId;
    public function mount($establishmentId)
    {
        $this->establishmentId = $establishmentId;

        // Aqui você pode carregar os espaços relacionados a esse estabelecimento, se necessário
    }



    public function incrementar($index)
    {
        $this->espacos[$index]['quantidade']++;
    }

    public function decrementar($index)
    {
        if ($this->espacos[$index]['quantidade'] > 0) {
            $this->espacos[$index]['quantidade']--;
        }
    }

    public function adicionarEspaco()
    {
        $this->espacos[] = ['nome' => '', 'quantidade' => 0];
    }

    public function salvar()
    {
        $establishmentId = $this->establishmentId;

        foreach ($this->espacos as $space) {
            for ($i=0; $i < $space['quantidade']; $i++) {
                $area = new Area;
                $area->id_empresa = $establishmentId;
                $a=1+$i;
                $area->designacao = $space['nome'].$a;
                $area->save();
                DB::table('plano_higienizacao')->insert([
                    'id_empresa' => $establishmentId,
                    'id_area' => $area->id,
                ]);
            }

        }
        $this->isBlocked = true; // Bloquear após salvar
        session()->flash('message', 'Espaços atualizados com sucesso!');
    }
    public function render()
    {
        return view('livewire.espaco-manager');
    }
}
