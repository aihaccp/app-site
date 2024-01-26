<?php

namespace App\Http\Livewire;

use App\Models\Equipamento;
use App\Models\Area;
use Livewire\Component;

class AddEquipment extends Component
{
    public $isBlocked = false;
    public $equipamentos = [];
    public $spaceId;
    public function mount($spaceId)
    {
        $this->spaceId = $spaceId;

        // Aqui você pode carregar os espaços relacionados a esse estabelecimento, se necessário
    }


    public function incrementar($index)
    {
        $this->equipamentos[$index]['quantidade']++;
    }

    public function decrementar($index)
    {
        if ($this->equipamentos[$index]['quantidade'] > 0) {
            $this->equipamentos[$index]['quantidade']--;
        }
    }

    public function adicionarEquipamento()
    {
        $this->equipamentos[] = ['nome' => '', 'quantidade' => 0];
    }

    public function salvar()
    {
        $establishmentId = Area::where('id',$this->spaceId)->first();

        foreach ($this->equipamentos as $equipamento) {
            for ($i=0; $i < $equipamento['quantidade']; $i++) {
                $area = new Equipamento;
                $area->id_empresa = $establishmentId->id_empresa;
                $area->id_area = $this->spaceId;
                $a=1+$i;
                $area->nome = $equipamento['nome']."_".$a;
                $area->save();
            }

        }
        $this->isBlocked = true; // Bloquear após salvar
        session()->flash('message', 'Espaços atualizados com sucesso!');
    }

    public function render()
    {
        return view('livewire.add-equipment');
    }
}
