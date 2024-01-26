<?php

namespace App\Http\Controllers;

use App\Models\Organition;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    public function registo_pessoal(Request $request){

        return view('registo_inicial.registo_pessoal');
    }

    public function registo_estabelecimento(Request $request){
        $empresaUuid = $request->input('empresa');
        $empresaid = Organition::where('uuid', $empresaUuid)->first();
        $companies = Company::where('organition_id', $empresaid->id)->get();
        return view('registo_inicial.registo_estabelecimentos')->with(['establishments'=>$companies]);
    }

    public function salvar_espacos(Request $request){
        dd($request->input('nomespace0'));

    }

    public function registo_equipamentos(Request $request){
        $empresaUuid = $request->input('empresa');
        $empresaid = Organition::where('uuid', $empresaUuid)->first();
        $companies = Company::where('organition_id', $empresaid->id)->get();
        return view('registo_inicial.registo_equipamentos')->with(['establishments'=>$companies]);
    }
    public function registo_espacos(Request $request){
        $empresaUuid = $request->input('empresa');
        $empresaid = Organition::where('uuid', $empresaUuid)->first();
        $companies = Company::where('organition_id', $empresaid->id)->get();
        return view('registo_inicial.registo_espacos')->with(['establishments'=>$companies]);
    }
    public function store(Request $request)
    {

        // Validação dos campos do formulário
        try {
            // Validação dos campos do formulário
            $validatedData = $request->validate([
                'nome' => 'required',
                'morada' => 'required',
                'localidade' => 'required',
                'cp' => 'required',
                'nipc' => 'required',
                'n_stores'=> 'required',
            ]);
        } catch (ValidationException $e) {
            dd($e->errors());
        }

        // Salvar os dados na tabela "companies"
        $organization = new Organition;
        $organization->name = $request->input('nome');
        $organization->morada = $request->input('morada');
        $organization->cp = $request->input('cp');
        $organization->localidade = $request->input('localidade');
        $organization->nipc = $request->input('nipc');
        $organization->n_stores = $request->input('n_stores');
        $organization->save();


        for ($i = 0; $i < $organization->n_stores; $i++) {
            $company = new Company;
            $company->organition_id = $organization->id; // Atribui o ID da Organition à Company
            $company->save();
        }

        session(['empresa_id' => $organization->uuid]);
        // Ou
        return redirect('/registo-estabelecimento?empresa=' . $organization->uuid);

   }
}
