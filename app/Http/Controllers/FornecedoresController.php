<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class FornecedoresController extends Controller
{
    //

    public function companies(){
        return $this->belongsToMany(Company::class, 'company_fornecedores');
    }
    public function show()
    {
        $id_empresa = Auth::user()->id_company;
        $empresa = Company::find($id_empresa);
        $fornecedores = $empresa->fornecedores;

        return $fornecedores;

    }
}

