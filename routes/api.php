<?php

use App\Models\Area;
use App\Models\Company;
use App\Models\Equipamento;
use App\Models\LogRegister;
use App\Models\RegistoHigienizacao;
use App\Models\RegistoTemperatura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', function(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    });
});

Route::post('/get-produtos', function (Request $request) {
    // Verificar se os parâmetros estão presentes na requisição
    $id_empresa = $request->input('id_empresa');
    $id_area = $request->input('id_area');
    
    if(!$id_empresa || !$id_area) {
        return response()->json(['error' => 'id_empresa e id_area são necessários'], 400);
    }

    // Fazer a consulta para obter os produtos químicos
    $produtos = DB::select('
        select produto_quimico.* 
        from produto_quimico, plano_higienizacao, item_acao_frequencia 
        where plano_higienizacao.id_empresa = ? 
          and plano_higienizacao.id_area = ? 
          and item_acao_frequencia.id_plano_higienizacao = plano_higienizacao.id 
          and item_acao_frequencia.id_produto_quimico = produto_quimico.id',
        [$id_empresa, $id_area]
    );

    // Retornar os resultados como JSON
    return response()->json($produtos);
});

Route::post('/submeter-registo-higienizacao', function (Request $request){
    try {
        $id_company = $request->data['id_company'];
        $registo = new RegistoHigienizacao;
        $registo->id_empresa = $id_company;
        $registo->id_area = $request->data['id_area'];
        $registo->id_user = $request->data['registeredBy'];
        $registo->id_acao_frequencia = 1;
        $registo->save();

        $log = new LogRegister;
        $log->user_id = $request->data['registeredBy'];
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 1;
        $log->acao = '[App] Registo da Higienização da ' . Area::where('id', $registo->id_area)->first()->designacao;
        $log->save();
        return response()->json(['error'=> false, 'message'=>'Tudo OK!'], 200); 
    } catch (\Throwable $th) {
        //throw $th;
    }
});
Route::post('/submeter-registo-temperatura', function (Request $request){
    try {
        
        $id_company = $request->data['id_company'];
        $registo = new RegistoTemperatura;
        $registo->id_empresa = $id_company;
        $registo->id_user = $request->data['registeredBy'];
        $registo->id_equipamento =$request->data['id_equipamento'];
        $registo->temp = $request->data['temp'];
        if (isset($request->data['observation']))
            $registo->observacao = $request->data['observation'];
        else
            $registo->observacao = "";
        $registo->save();
        Log::info($registo);
        $log = new LogRegister;
        $log->user_id = $request->data['registeredBy'];
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 1;
        $log->acao = '[App] Registo da Temperatura da/o ' . Equipamento::where('id', $registo->id_equipamento)->first()->nome . ' na ' . Area::where('id', Equipamento::where('id', $registo->id_equipamento)->first()->id)->first()->designacao;
        $log->save();
        return response()->json(['error'=> false, 'message'=>'Tudo OK!'], 200); 
    } catch (\Throwable $th) {
        //throw $th;
    }
});



Route::post('/get-info-equipamento', function (Request $request) {
    $dataUrl = $request->input('data');
    $uuid = last(explode('/', $dataUrl));
    $equipamento = Equipamento::where("uuid", $uuid)->first();
    $tipo = $equipamento->tipo;
    $nome = $equipamento->nome;
    $temp_max = $equipamento->temp_max;
    $temp_min = $equipamento->temp_min;
    $id_area = $equipamento->id_area;
    $area = Area::where('id', $id_area)->first()->designacao;
    return response()->json(['id'=> $equipamento->id,'id_company' => $equipamento->id_empresa,'id_area'=> $equipamento->id_area, 'id_acao_frequencia'=> $equipamento->id_acao_frequencia,'tipo' => $tipo, 'nome' => $nome, 'area' => $area, 'temp_max' => $temp_max, 'temp_min' => $temp_min]);
});
Route::post("/login-app", function (Request $request){
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email'=> ['The provided credentials are incorret']
        ]);
        # code...
    }
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
});
