<?php

use App\Http\Controllers\OpenAiController;
use App\Models\Company;
use App\Models\Organition;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserGerenteController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\RegistoController;
use App\Http\Controllers\GerenteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/equipaments', [OpenAiController::class, 'index'])->name('index');
Route::get('/registo-pessoal', [EmpresaController::class, 'registo_pessoal'])->name('registo_pessoal');
Route::get('/registo-equipamentos', [EmpresaController::class, 'registo_equipamentos'])->name('registo_equipamentos');
Route::get('/registo-espacos', [EmpresaController::class, 'registo_espacos'])->name('registo_espacos');
Route::post('/registo-user', [UserGerenteController::class, 'registo_user'])->name('registo-user');
Route::post('/registo-empresa', [EmpresaController::class, 'store'])->name('registo-empresa');
Route::get('/registo-estabelecimento', [EmpresaController::class, 'registo_estabelecimento'])->name('registo_estabelecimento');
Route::get('/confirmacao-registo', [PageController::class, 'confirmacao_registo'])->name('confirmacao_registo');
Route::get('/registo-gerente', [PageController::class, 'registo_gerente'])->name('registo-gerente');
Route::get('/registo-empresa', [PageController::class, 'registo_empresa'])->name('registo_empresa');
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {


    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/dashboard/{module}/{folder}/adicionar', [HomeController::class, 'novoRegisto2'])->name('novoRegisto2');

    Route::prefix('modules')->group(function () {
        Route::get('{moduleSlug}', [ModuleController::class, 'show'])->name('modules-show');
        Route::get('{moduleSlug}/folders/{folderSlug}', [FolderController::class, 'show'])->name('folders-show');
        Route::get('{moduleSlug}/folders/{folderSlug}/adicionar', [RegistoController::class, 'show'] )->name('registo-add');

    });

    Route::post('/modificarFicheiro', [HomeController::class, 'modificarFicheiro'])->name('modificarFicheiro');

    Route::post('/downloadFicheiro', [HomeController::class, 'downloadFicheiro'])->name('downloadFicheiro');

    Route::post('/exportarPdf', [HomeController::class, 'exportarPdf'])->name('exportarPdf');

    Route::post('/submeterRegistoHigienizacao', [HomeController::class, 'submeterRegistoHigienizacao'])->name('submeterRegistoHigienizacao');

    Route::post('/submeterRegistoTemperatura', [HomeController::class, 'submeterRegistoTemperatura'])->name('submeterRegistoTemperatura');
    Route::post('/submeterRegistoAcoesCorretivas', [HomeController::class, 'submeterRegistoAcoesCorretivas'])->name('submeterRegistoAcoesCorretivas');
    Route::post('/submeterDemonstracaoProcedimento', [HomeController::class, 'submeterDemonstracaoProcedimento'])->name('submeterDemonstracaoProcedimento');

    Route::post('submterRegistoVerificacao', [HomeController::class, 'submeterRegistoVerificacao'])->name('submeterRegistoVerificacao');
    Route::get('/chat', function () {

        return view('chatteste');

});

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {

                return view('admin.show');

        });
    });

    Route::middleware('role:gerente,admin')->group(function () {
        Route::get('/register', function () {
            return view('auth.register');
        })->name('register');
        Route::get('/plan-HACCP', function () {
            return view('haccp_plan');
        })->name('haccp_plan');
        Route::post('/register-post', [HomeController::class, 'create_user'])->name('register-post');
    });

    Route::middleware('role:gerente')->group(function () {
        Route::get('/selecionar-estabelecimento', function () {
            $uuid = Organition::where('id',Auth::user()->id_company)->first()->id;
            return view('gerente.select_estabelecimento')->with('uuid', $uuid);
        })->name('select_esta');
        Route::prefix('gestao')->group( function () {
            Route::get('empresa', [GerenteController::class, 'show'])->name('gerente-show');
        });

    });
});
