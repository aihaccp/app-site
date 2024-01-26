<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    //
    public function show($moduleSlug)
    {
        $module = Module::where('slug', $moduleSlug)->firstOrFail();
        $folders = $module->folders;
        if ($folders->isEmpty()) {
            $modulePath = 'modules.' . $moduleSlug . '.show';
            if (view()->exists($modulePath)) {
                if(strcmp($moduleSlug, "fornecedores")==0){
                    $fornecedorController = new FornecedoresController();
                    $fornecedores = $fornecedorController->show();
                    return view($modulePath)->with(['fornecedores' => $fornecedores]);


                }
                return view($modulePath);

            }else{
                abort(404);
            }

        }else{
            return view('folders', compact('module', 'folders'));
        }
    }
}
