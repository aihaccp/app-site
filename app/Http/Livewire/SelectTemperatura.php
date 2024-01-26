<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Equipamento;

class SelectTemperatura extends Component
{
    public $areaId = 0;
    public $equipamentoId = 0;
    public $temperatura;
    public $areas;
    public $equipamentos;
    public $temp_max;
    public $temp_min;
    public $id_company;

    protected $listeners = ['submeterFormRegisto'];

    public function messages(){
        return [
            'areaId.not_in' => 'Campo obrigatório',
            'equipamentoId.not_in' => 'Campo obrigatório',
            'temperatura' => 'Campo obrigatório'
        ];
    }

    public function render()
    {
        return view('livewire.select-temperatura');
    }

    public function mount(){
        $user = Auth::user();
        $uuid = session('uuid');
        $this->id_company= Company::where('uuid', $uuid)->first();
        $this->equipamentos = collect([]);
        $this->areas = DB::select('select area.id, area.designacao from area where area.id_empresa = ?', [$this->id_company->id]);
        $this->areas = json_encode($this->areas);
    }

    public function updatedAreaId($value){
        $user = Auth::user();
        $this->equipamentoId = 0;
        $this->equipamentos = DB::select('select equipamento.* from equipamento, area where area.id = ? and area.id = equipamento.id_area and equipamento.id_empresa = ?', [$this->areaId, $this->id_company->id]);
        $this->equipamentos = json_encode($this->equipamentos);
    }

    public function updatedEquipamentoId($value){
        $equipamento = Equipamento::where('id', $this->equipamentoId)->first();
        $this->temp_max = $equipamento->temp_max;
        $this->temp_min = $equipamento->temp_min;
    }

    public function submeterFormRegisto($request){
        $this->validate([
            'areaId' => ['required', 'not_in:0'],
            'equipamentoId' => ['required', 'not_in:0'],
            'temperatura' => ['required']
        ]);

        $this->emit('submeterFormValidado');
    }
}
