<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class SelectHigienizacao extends Component
{
    public $areaId = 0;
    public $itemId = 0;
    public $produtoId = 0;
    public $areas;
    public $itens;
    public $produtos;

    public $frequencia;
    public $id_acao_frequencia;
    public $estabelecimentoGeral;
    protected $listeners = ['submeterFormRegisto'];


    public function messages(){
        return [
            'areaId.not_in' => 'Campo obrigatório',
            'itemId.not_in' => 'Campo obrigatório'
        ];
    }


    public function render()
    {
        return view('livewire.select-higienizacao');
    }

    public function mount(){
        $user = Auth::user();
        $uuid = session('uuid');
        $this->estabelecimentoGeral = Company::where('uuid', $uuid)->first();
        $this->itens = collect([]);
        $this->produtos = collect([]);
        $this->areas = DB::select('select area.id, area.designacao from area, plano_higienizacao where plano_higienizacao.id_empresa = ? and plano_higienizacao.id_area = area.id', [$this->estabelecimentoGeral->id]);
        $this->areas = json_encode($this->areas);
    }

    public function updatedAreaId($value){
        $user = Auth::user();
        $this->itemId = 0;
        $this->itens = DB::select('select equipamento.* from equipamento, area where area.id = ? and area.id = equipamento.id_area and equipamento.id_empresa = ?', [$this->areaId, $this->estabelecimentoGeral->id]);
        $this->itens = json_encode($this->itens);
    }

    public function updatedItemId($value){
        $user = Auth::user();
        $this->produtos = DB::select('select produto_quimico.* from produto_quimico, plano_higienizacao, item_acao_frequencia where plano_higienizacao.id_empresa = ? and plano_higienizacao.id_area = ? and item_acao_frequencia.id_plano_higienizacao = plano_higienizacao.id and item_acao_frequencia.id_produto_quimico = produto_quimico.id', [$this->estabelecimentoGeral->id, $this->areaId]);
        $this->produtos = json_encode($this->produtos);
    }

    public function updatedProdutoId($value){
        $user = Auth::user();
        $item_acao_frequencia =DB::select('select item_acao_frequencia.* from item_acao_frequencia, plano_higienizacao where plano_higienizacao.id_empresa = ? and plano_higienizacao.id_area = ? and plano_higienizacao.id = item_acao_frequencia.id_plano_higienizacao and item_acao_frequencia.id_item = ? and item_acao_frequencia.id_produto_quimico = ?', [$this->estabelecimentoGeral->id, $this->areaId, $this->itemId, $this->produtoId]);
        $this->id_acao_frequencia = $item_acao_frequencia[0]->id;
        $this->frequencia = DB::select('select frequencia.* from frequencia where id = ?', [$item_acao_frequencia[0]->id_frequencia])[0]->designacao;
    }

    public function submeterFormRegisto($request){
        $this->validate([
            'areaId' => ['required', 'not_in:0'],
            'itemId' => ['required', 'not_in:0'],
            'id_acao_frequencia' => ['required', 'not_in:0']
        ]);

        $this->emit('submeterFormValidado');
    }
}
