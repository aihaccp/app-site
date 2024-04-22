<?php

namespace App\Http\Controllers;

use App\Mail\PasswordGenerated;
use App\Models\Area;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;

use App\Models\File;
use App\Models\Folder;
use App\Models\Folder_Module;
use App\Models\RegistoDemonstracaoProcedimento;
use App\Models\RegistoAcoesCorretivas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistoHigienizacao;
use App\Models\ItemAcaoFrequencia;
use App\Models\RegistoTemperatura;
use App\Models\Equipamento;
use App\Models\RegistoAberturaFecho;
use App\Models\VerificacaoAberturaFecho;
use App\Models\AberturaFecho;
use App\Models\RegistoVerificacaoAberturaFecho;
use App\Models\Alerta;
use App\Models\Company;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\LogRegister;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function configuracao(){
        return view('configuracao');
    }
    public function downloadQrCode($uuid)
    {
        $qrCode = QrCode::format('png')
            ->size(200) // Tamanho do QR Code
            ->generate(route('equipamentos.edit', ['uuid' => $uuid])); // URL que você quer codificar

        $output = 'QRCode_' . $uuid . '.png';
        return response()->streamDownload(function () use ($qrCode) {
            echo $qrCode;
        }, $output);
    }
    public function espacos()
    {
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $espacos = Area::where('id_empresa', $id_company)->get();
        return view('espacos')->with(['espacos' => $espacos]);
    }

    public function edi_equi($espacoId, $equipamentoId)
    {
        $espaco = Area::where('uuid', $espacoId)->first();
        $equipamento = Equipamento::where('uuid', $equipamentoId)->first();
        return view('edit.equipamentos')->with(['equipamento' => $equipamento, 'area' => $espaco]);
    }
    public function add_equi($espacoId)
    {
        $espaco = Area::where('uuid', $espacoId)->first();
        return view('edit.add_equipamento')->with(['area' => $espaco]);
    }
    public function equipamentos($area)
    {
        $area1 = Area::where('uuid', $area)->first();
        $equipamentos = $area1->equipments;
        return view('equipamentos')->with(['equipamentos' => $equipamentos, 'area' => $area1]);
    }
    public function create_user(Request $request)
    {
        $generatedPassword = Str::random(12);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_company' => $request->company_id,
            'role_id' => $request->role_id,
            'password' => Hash::make($generatedPassword),
        ]);

        //$user->sendEmailVerificationNotification();

        Mail::to($user->email)->send(new PasswordGenerated($generatedPassword));

        Session::flash('success', 'Registro bem-sucedido! Verifique seu e-mail para obter sua senha.');

        return redirect()->back();
    }
    public function dashboard()
    {
        $modules = User::getModulesAllowed();
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $data = date("Y-m-d");
        $totalequipa = User::where("id_company", $user->id_company)->count();
        $alertas_count = Alerta::where("id_empresa", $id_company)->count();
        $alertas = Alerta::where("id_empresa", $id_company)->get();
        $espacos_count = Area::where("id_empresa", $id_company)->count();
        $equipamentos_count = Equipamento::where("id_empresa", $id_company)->count();
        $log_registos = LogRegister::where("company_id", $user->id_company)->get();
        $alertaAbertura = Alerta::where('id_empresa', $id_company)->where('tipo', 0)->orderBy('created_at', 'desc')->whereDate('created_at', $data)->first();
        $alertaFecho = Alerta::where('id_empresa', $id_company)->where('tipo', 1)->orderBy('created_at', 'desc')->whereDate('created_at', $data)->first();
        return view('dashboard22', ['log_registos' => $log_registos, 'equipamentos_count' => $equipamentos_count, 'espacos_count' => $espacos_count, 'alerta_count' => $alertas_count, 'alertas' => $alertas, 'totalequipa' => $totalequipa, 'modules' => $modules, 'alertaAber' => $alertaAbertura, 'alertaFecho' => $alertaFecho]);
    }

    public function redirecionarModule($module, $folder = null, $registo = null)
    {
        if (!isset($registo)) {
            if (!isset($folder)) {
                $moduleObject = Module::where('name', $module)->first();
                $folders = Module::getFolders($moduleObject->id);
                if (count($folders) !== 0) {
                    return view('folders', ['folders' => $folders, 'module' => $moduleObject->name]);
                } else {
                    $files = Module::getFiles($moduleObject->id);
                    return view('files', ['files' => $files, 'module' => $moduleObject->name]);
                }
            } else {
                $moduleObject = Module::where('name', $module)->first();
                $folderObject = Folder::where('name', $folder)->first();
                if ($folderObject->type != 0 && $folderObject->type != 1)
                    return $this->redirecionarRegisto($module, $folder);
                $folders = Folder::getFolders($folderObject->id);
                if (count($folders) !== 0) {
                    return view('folders', ['folders' => $folders, 'module' => $moduleObject->name, 'folder' => $folderObject->name]);
                } else {
                    $files = Folder::getFiles($folderObject->id);
                    return view('files', ['files' => $files, 'module' => $moduleObject->name, 'folder' => $folderObject->name]);
                }
            }
        } else {
            return $this->redirecionarRegisto($module, $folder, $registo);
        }

    }

    public function redirecionarRegisto($module, $folder = null, $registo = null)
    {
        $moduleObject = Module::where('name', $module)->first();
        $folderObject = Folder::where('name', $folder)->first();
        $registoObject = Folder::where('name', $registo)->first();

        if ($registo === null)
            $registoObject = $folderObject;

        if ($registoObject->type == 2) {
            return $this->redirecionarHigienizacao($moduleObject, $folderObject, $registoObject);
        }
        if ($registoObject->type == 3) {
            return $this->redirecionarTemperatura($moduleObject, $folderObject, $registoObject);
        }
        if ($registoObject->type == 4) {
            return $this->redirecionarcorrectiveactions($moduleObject, $folderObject, $registoObject);
        }
        if ($registoObject->type == 5) {
            return $this->redirecionardemonstracaoprocedimentos($moduleObject, $folderObject, $registoObject);
        }
        if ($registoObject->type == 6) {
            return $this->redirecionarVerificacaoAbertura($moduleObject, $folderObject);
        }
        if ($registoObject->type == 7) {
            return $this->redirecionarVerificacaoFecho($moduleObject, $folderObject);
        }

    }

    public function redirecionarHigienizacao($moduleObject, $folderObject, $registoObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoHigienizacao::where('id_empresa', $id_company)->orderByDesc('created_at')->get();
        foreach ($registos as $registo) {
            $item_acao_frequencia = ItemAcaoFrequencia::where('id', $registo->id_acao_frequencia)->first();
            $registo->id_item = $item_acao_frequencia->id_item;
        }
        return view('sanitation', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name, 'registo' => $registoObject->name]);
    }

    public function redirecionarTemperatura($moduleObject, $folderObject, $registoObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoTemperatura::where('id_empresa', $id_company)->orderByDesc('created_at')->get();
        foreach ($registos as $registo) {
            $equipamento = Equipamento::where('id', $registo->id_equipamento)->first();
            $registo->temp_min = $equipamento->temp_min;
            $registo->temp_max = $equipamento->temp_max;
        }
        return view('temperature', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name, 'registo' => $registoObject->name]);
    }

    public function redirecionarcorrectiveactions($moduleObject, $folderObject, $registoObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoAcoesCorretivas::where('id_empresa', $id_company)->get();


        return view('correctiveactions', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name, 'registo' => $registoObject->name]);
    }

    public function redirecionardemonstracaoprocedimentos($moduleObject, $folderObject, $registoObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoDemonstracaoProcedimento::where('id_empresa', $id_company)->get();


        return view('demonstracaoprocedimento', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name, 'registo' => $registoObject->name]);
    }
    public function auditorias_details($uuidauditoria){
        $auditoria = Auditoria::where('uuid', $uuidauditoria)->first();
        return view('auditorias.individual', ['auditoria' => $auditoria]);
    }
    public function auditorias_registos($uuidauditoria){
        $auditoria = Auditoria::where('uuid', $uuidauditoria)->first();
        return view('auditorias.registo', ['auditoria' => $auditoria]);
    }

    public function redirecionarVerificacaoAbertura($moduleObject, $folderObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho', 0)->get();

        return view('verificacao-abertura-fecho', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name]);
    }

    public function redirecionarVerificacaoFecho($moduleObject, $folderObject)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho', 1)->get();

        return view('verificacao-abertura-fecho', ['registos' => $registos, 'module' => $moduleObject->name, 'folder' => $folderObject->name]);
    }

    public function modificarFicheiro(Request $request)
    {
        if ($request->file('ficheiro')) {
            $file = File::where('id', $request->id)->first();
            //Storage::delete($file->avatar);

            $path = $request->module;
            if (isset($request->folder))
                $path = $path . "/" . $request->folder;

            $fileaux = $request->file('ficheiro');
            $filename = time() . '.' . $fileaux->getClientOriginalExtension();

            $fileaux->storeAs($path . '/' . $file->id_company, $filename);

            $file->name = pathinfo($fileaux->getClientOriginalName(), PATHINFO_FILENAME) . "." . $fileaux->getClientOriginalExtension();
            $file->avatar = $path . '/' . $file->id_company . '/' . $filename;
            $file->save();
        }
        return redirect()->back();
        ;
    }

    public function downloadFicheiro(Request $request)
    {
        $file = Folder::where('id', $request->id)->first();
        if ($file !== null)
            return Storage::download($file->avatar, $file->name);
        else
            return redirect()->back();
    }

    public function exportarPdf(Request $request)
    {
        $file = Folder::where('id', $request->id)->first();
        if ($file !== null) {
            $fileaux = Storage::get($file->avatar);
            $domPdfPath = base_path('vendor/dompdf/dompdf');
            \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            $Content = \PhpOffice\PhpWord\IOFactory::load(storage_path("app/" . $file->avatar));
            $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');

            $filenew = new Folder;
            $filenew->id_company = $file->id_company;
            $filenew->type = $file->type;
            $filenew->dad = $file->dad;

            $filename = time() . '.' . $fileaux->getClientOriginalExtension();
            $name = str_replace(".doc", ".pdf", $file->name);
            $name = str_replace(".docx", ".pdf", $name);

            $PDFWriter->storeAs($request->module . '/' . $file->id_company, $filename);

            $filenew->name = $name;
            $filenew->avatar = $request->module . '/' . $file->id_company . '/' . $filename;
            $filenew->save();

            $module = Module::where('name', $request->module)->first();

            $folder_module = new Folder_Module;
            $folder_module->id_folders = $filenew->id;
            $folder_module->id_modules = $module->id;
            $folder_module->save();
        }
        return redirect()->route('redirecionarModule', [$request->module]);
    }

    public function novoRegisto($module, $folder, $registo)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registoObject = Folder::where('name', $registo)->first();

        if ($registoObject->type == 2) {
            $registos = RegistoHigienizacao::where('id_empresa', $id_company)->get();
            foreach ($registos as $registoAux) {
                $item_acao_frequencia = ItemAcaoFrequencia::where('id', $registoAux->id_acao_frequencia)->first();
                $registoAux->id_item = $item_acao_frequencia->id_item;
            }
            return view('sanitation-new-record', ['module' => $module, 'folder' => $folder, 'registo' => $registo, 'registos' => $registos]);
        }
        if ($registoObject->type == 3) {
            $registos = RegistoTemperatura::where('id_empresa', $id_company)->get();
            foreach ($registos as $registoAux) {
                $equipamento = Equipamento::where('id', $registoAux->id_equipamento)->first();
                $registoAux->temp_min = $equipamento->temp_min;
                $registoAux->temp_max = $equipamento->temp_max;
            }
            return view('temperature-new-record', ['module' => $module, 'folder' => $folder, 'registo' => $registo, 'registos' => $registos]);
        }
        if ($registoObject->type == 4) {
            $registos = RegistoAcoesCorretivas::where('id_empresa', $id_company)->get();
            return view('acoes-corretivas-new-record', ['module' => $module, 'folder' => $folder, 'registo' => $registo, 'registos' => $registos]);
        }
        if ($registoObject->type == 5) {
            $registos = RegistoDemonstracaoProcedimento::where('id_empresa', $id_company)->get();
            return view('demonstracao-procedimentos-new-record', ['module' => $module, 'folder' => $folder, 'registo' => $registo, 'registos' => $registos]);
        }
    }

    public function submeterRegistoHigienizacao(Request $request)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registo = new RegistoHigienizacao;
        $registo->id_empresa = $id_company;
        $registo->id_area = $request->id_area;
        $registo->id_user = $user->id;
        $registo->id_acao_frequencia = $request->id_acao_frequencia;
        $registo->save();

        $log = new LogRegister;
        $log->user_id = $user->id;
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 1;
        $log->acao = 'Registo da Higienização da ' . Area::where('id', $registo->id_area)->first()->designacao;
        $log->save();
        return redirect()->back();
    }


    public function submeterRegistoTemperatura(Request $request)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registo = new RegistoTemperatura;
        $registo->id_empresa = $id_company;
        $registo->id_user = $user->id;
        $registo->id_equipamento = $request->id_equipamento;
        $registo->temp = $request->temp;
        if (isset($request->observacao))
            $registo->observacao = $request->observacao;
        else
            $registo->observacao = "";
        $registo->save();

        $log = new LogRegister;
        $log->user_id = $user->id;
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 2;
        $log->acao = 'Registo da Temperatura da/o ' . Equipamento::where('id', $registo->id_equipamento)->first()->nome . ' na ' . Area::where('id', Equipamento::where('id', $registo->id_equipamento)->first()->id)->first()->designacao;
        $log->save();
        return redirect()->back();
    }

    public function submeterRegistoAcoesCorretivas(Request $request)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registo = new RegistoAcoesCorretivas;
        $registo->id_empresa = $id_company;
        $registo->id_user = $user->id;
        $registo->problema = $request->problema;
        $registo->descricao = $request->descricao;
        $registo->save();

        $log = new LogRegister;
        $log->user_id = $user->id;
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 2;
        $log->acao = 'Registo de uma Ação Corretiva ';
        $log->save();

        return redirect()->back();
    }
    public function submeterDemonstracaoProcedimento(Request $request)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $registo = new RegistoDemonstracaoProcedimento;
        $registo->id_empresa = $id_company;
        $registo->id_user = $user->id;
        $registo->ponto_seguranca = $request->ponto_seguranca;
        $registo->explicacao = $request->explicacao;
        $registo->save();

        $log = new LogRegister;
        $log->user_id = $user->id;
        $log->company_id = $id_company;
        $log->register_id = $registo->id;
        $log->page_config_id = 2;
        $log->acao = 'Registo de uma demonstração de um Procedimento ';
        $log->save();

        return redirect()->back();
    }

    public function submeterRegistoVerificacao(Request $request)
    {
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $abertura_fecho = AberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho', $request->tipo)->first();
        $verificacoes = VerificacaoAberturaFecho::where('id_abertura_fecho', $abertura_fecho->id)->get();

        $registo_abertura_fecho = new RegistoAberturaFecho;
        $registo_abertura_fecho->id_empresa = $id_company;
        $registo_abertura_fecho->id_abertura_fecho = $abertura_fecho->id;
        $registo_abertura_fecho->id_user = $user->id;
        $registo_abertura_fecho->tipo_abertura_fecho = $request->tipo;
        $registo_abertura_fecho->save();

        foreach ($verificacoes as $verificacao) {
            $id = $verificacao->id;
            if (isset($request->$id) && $request->$id === "1") {
                $registo_verificacao = new RegistoVerificacaoAberturaFecho;
                $registo_verificacao->id_registo_aber_fec = $registo_abertura_fecho->id;
                $registo_verificacao->id_verif_aber_fec = $verificacao->id;
                $registo_verificacao->verificado = 1;
                $registo_verificacao->save();
            } else {
                $registo_verificacao = new RegistoVerificacaoAberturaFecho;
                $registo_verificacao->id_registo_aber_fec = $registo_abertura_fecho->id;
                $registo_verificacao->id_verif_aber_fec = $verificacao->id;
                $registo_verificacao->verificado = 0;
                $registo_verificacao->save();
            }
        }

        $alerta = Alerta::where('id_empresa', $id_company)->where('tipo', $request->tipo)->orderBy('created_at', 'desc')->first();
        if ($request->tipo === "1" && $alerta) {
            $empresa = Company::where('id', $id_company)->first();
            $currentDateTime = new DateTime();
            $previousDay = $currentDateTime->sub(new DateInterval('P1D'));
            $prevDayWithTime = $previousDay->format('Y-m-d') . ' ' . $empresa->hora_abertura;

            $currentDate = new DateTime(date('Y-m-d') . ' ' . $empresa->hora_abertura);

            $timestampDate = new DateTime(date('Y-m-d H:i:s', strtotime($alerta->created_at)));

            if ($prevDayWithTime < $timestampDate && $timestampDate < $currentDate)
                $alerta->delete();
        }

        if ($request->tipo === "0" && $alerta) {
            $timestampDate = date('Y-m-d', strtotime($alerta->created_at));
            $currentDate = date('Y-m-d');
            if ($timestampDate === $currentDate)
                $alerta->delete();
        }
        $modulePath = 'modules/' . $request->module;
        return redirect($modulePath);
    }
}
