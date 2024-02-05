<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Organition;
use Livewire\Component;
use Livewire\WithFileUploads;

class EstablishmentManager extends Component
{
    use WithFileUploads;
    public $activePanel;
    public $organizationUuid = null;
    public $organizationId;
    public $companies = [];
     public $errorMessage = '';
     public $allCompaniesSaved = false;
    protected $rules = [
        'companies.*.name' => 'required|string|max:255',
        'companies.*.morada' => 'required|string|max:255',
        'companies.*.cp' => 'required|string|max:10',
        'companies.*.cae' => 'required|string',
        'companies.*.localidade' => 'required|string|max:255',
        'companies.*.n_users' => 'required|integer|min:1',
        // Adicione aqui outras regras de validação para os campos restantes
    ];

    public function mount($organizationId = null)
    {
        $this->organizationUuid = request()->input('empresa');
        $this->organizationId = $organizationId ?? Organition::where('uuid', request()->input('empresa'))->first()->id;
        $this->loadCompanies();
    }

    public function loadCompanies()
    {
        if ($this->organizationId) {
            $this->companies = Organition::find($this->organizationId)->companies;
        }
    }
    public function isEstablishmentFilled($establishment)
    {
        return isset($establishment->name) && isset($establishment->morada) && isset($establishment->cp) && isset($establishment->localidade) && isset($establishment->n_users) && isset($establishment->cae);
    }
    public function toggleStatus($companyId)
    {
        $company = Company::find($companyId);
        $company->status = $company->status === 1 ? 0 : 1; // Alternar entre 0 e 1
        $company->save();

        $this->loadCompanies(); // Recarregar os estabelecimentos para refletir as mudanças
    }
    public function saveCompany($index)
    {

        $companyData = $this->companies[$index];

        // Aqui você pode adicionar validação dos dados

        $company = Company::find($companyData['id']);

        if ($company) {
            $company->update([
                'name' => $companyData['name'],
                'morada' => $companyData['morada'],
                'cp' => $companyData['cp'],
                'localidade' => $companyData['localidade'],
                'n_users' => $companyData['n_users'],
                'cae' => $companyData['cae'],
            ]);

            $this->dispatchBrowserEvent('notify', 'Estabelecimento salvo com sucesso!');
        }
        $this->allCompaniesSaved = true;
        $this->loadCompanies();
    }

    public function goToNextPage()
    {
        if (!$this->allCompaniesSaved) {
            $this->errorMessage = 'Por favor, guarde a informação dos estabelecimentos antes de prosseguir.';
            return;
        }
        return redirect()->to('/registo-espacos?empresa=' . $this->organizationUuid);
    }

    public function copyAddress($index)
    {
        $company = Organition::find($this->companies[0]->organition_id);

        if (isset($this->companies[0])) {
            $this->companies[$index]['morada'] = $company->morada;
            $this->companies[$index]['localidade'] = $company->localidade;
            $this->companies[$index]['cp'] = $company->cp;
        }
    }
    public function render()
    {
        return view('livewire.establishment-manager');
    }
}
