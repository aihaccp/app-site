<?php

namespace App\Http\Controllers;

use App\Models\LogRegister;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GerenteController extends Controller
{
    public function show()
    {
        $gerente_empresa= Auth::user()->id_company;
        $funcionarios= User::where('id_company', $gerente_empresa)->get();
        $logs =LogRegister::where('company_id', $gerente_empresa)->get();
        return view('gerente.control')->with(['funcionarios' => $funcionarios, 'logs' => $logs]);

    }
    public function store(Request $request)
    {
        return redirect('/registo-gerente?empresa=' );

    }
}
