<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function confirmacao_registo()
    {
        return view('registo_inicial.confirmacao_registo');
    }
    public function registo_empresa()
    {
        return view('registo_inicial.registo_empresa');
    }
    public function registo_gerente()
    {
        return view('registo_inicial.registo_gerente');
    }

}
