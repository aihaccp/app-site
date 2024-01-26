<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Mail\ConfirmacaoUserEmpresaEmail;
use Illuminate\Support\Facades\Mail;

class UserGerenteController extends Controller
{
    //
    public function  registo_user(Request $request)
    {
        // Obtém os dados do formulário
        $dadosFormulario = $request->only(['name', 'email', 'password']);
        $id_company = Company::where('uuid',$request->id_company)->first();
        $dadosFormulario['id_company']=$id_company->id;
        // Adicione a coluna "company" à matriz de dados com o valor da sessão

        $dadosFormulario['role_id'] = 3;
        $senhaCriptografada = Hash::make($dadosFormulario['password']);
        $dadosFormulario['password'] = $senhaCriptografada;

        // Crie um novo usuário usando o Jetstream
        $user = \App\Models\User::create($dadosFormulario);
        Mail::to($user->email)->send(new ConfirmacaoUserEmpresaEmail());
        // Faça login do usuário recém-criado
        //Auth::login($user);

        // Redirecione para a próxima página após o registro
        return redirect('/confirmacao-registo');
    }

}
