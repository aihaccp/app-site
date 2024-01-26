<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Organition;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordGenerated;
use Illuminate\Support\Facades\Mail;

class RegistoPessoal extends Component
{

    public $pessoal = [];


    public $organizationId;

    public function mount($organizationId = null)
    {
        $this->organizationUuid = request()->input('empresa');
        $this->organizationId = $organizationId ?? Organition::where('uuid', request()->input('empresa'))->first()->id;
    }
    public function save()
    {


        $rules = [
            'pessoal.name' => 'required|string|max:255',
            'pessoal.email' => 'required|string|email|max:255|unique:users,email',
            'pessoal.n_phone' => 'required|max:10',
            'pessoal.aceitaTermos' => 'required',


        ];

        $messages = [
            'pessoal.name.required' => 'O nome é obrigatório.',
            'pessoal.email.required' => 'O email é obrigatório.',
            'pessoal.email.email' => 'O email deve ser um endereço de email válido.',
            'pessoal.email.unique' => 'Este email já está em uso.',
            'pessoal.n_phone' => 'Numero de telemóvel obrigatório',
            'pessoal.aceitaTermos' => 'Lê e aceita os termos e condições para prosseguires.'
        ];

        $this->validate($rules, $messages);
        $generatedPassword = Str::random(12);
        $user = User::create([
            'name' => $this->pessoal['name'],
            'email' => $this->pessoal['email'],
            'password' => Hash::make($generatedPassword),
            'role_id' => 3,
            'subscreverNewsletter' => $this->pessoal['subscreverNewsletter'],
            'id_company' => $this->organizationId,
        ]);

        Mail::to($user->email)->send(new PasswordGenerated($generatedPassword));

        return redirect()->to('/confirmacao-registo?empresa='.$this->organizationUuid);
    }

    public function render()
    {
        return view('livewire.registo-pessoal');
    }
}
