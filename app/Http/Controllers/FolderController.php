<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Equipamento;
use App\Models\ItemAcaoFrequencia;
use App\Models\RegistoAberturaFecho;
use App\Models\RegistoAcoesCorretivas;
use App\Models\RegistoDemonstracaoProcedimento;
use App\Models\RegistoHigienizacao;
use App\Models\RegistoTemperatura;
use App\Models\RegistoVerificacaoAberturaFecho;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\PageConfig;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function show($moduleSlug, $folderSlug)
    {
        $module = Module::where('slug', $moduleSlug)->firstOrFail();
        $folder = $module->folders()->where('slug', $folderSlug)->firstOrFail();
        $files = $folder->files;
        if ($files->isEmpty()) {
            $pageConfig = $this->getPageConfig($moduleSlug, $folderSlug);

            if ($pageConfig) {
                $data = $this->prepareData($pageConfig);
                $modulePath = 'modules.' . $moduleSlug . '.folders.'. $folderSlug . '.show';
                if (isset($data['registos'])) {
                    return view($modulePath)->with(['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $data['registos']]);
                }else{
                    return view($modulePath)->with(['module'=>$data['module'],'folder'=>$folderSlug]);
                }

            } else {
                return response()->json([
                    'error' => 'Sem ficheiros, por favor adicione!'
                ], 200);
            }
        }else{
            return view('files', compact('module', 'folder', 'files'));
        }
    }
    private function getPageConfig($moduleSlug, $folderSlug)
    {
        return PageConfig::where('module_slug', $moduleSlug)
            ->where('folder_slug', $folderSlug)
            ->first();
    }

    private function prepareData($pageConfig)
    {
        $data = [];

        // Exemplo de configuração em que o nome da variável no banco de dados é 'title'
        $data['module'] = $pageConfig->module_slug;
        $data['folder'] = $pageConfig->folder_slug;
        $user = Auth::user();
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        if (strcmp($pageConfig->folder_slug, "higienizacao")==0) {
            $registos = RegistoHigienizacao::where('id_empresa', $id_company)->get();
            foreach($registos as $registoAux){
                $item_acao_frequencia = ItemAcaoFrequencia::where('id', $registoAux->id_acao_frequencia)->first();
                $registoAux->id_item = $item_acao_frequencia->id_item;
            }
        $data['registos']=$registos;
        }

        if (strcmp($pageConfig->folder_slug, "temperatura")==0) {
            $user = Auth::user();
            $registos = RegistoTemperatura::where('id_empresa', $id_company)->orderByDesc('created_at')->get();
            foreach($registos as $registo){
                $equipamento = Equipamento::where('id', $registo->id_equipamento)->first();
                $registo->temp_min = $equipamento->temp_min;
                $registo->temp_max = $equipamento->temp_max;
            }
            $data['registos']=$registos;
        }
        if (strcmp($pageConfig->folder_slug, "demonstracao-procedimentos")==0) {
            $registos = RegistoDemonstracaoProcedimento::where('id_empresa', $id_company)->get();
            $data['registos']=$registos;
        }
        if (strcmp($pageConfig->folder_slug, "acao-corretiva")==0) {
            $registos = RegistoAcoesCorretivas::where('id_empresa', $id_company)->get();
            $data['registos']=$registos;
        }
        if (strcmp($pageConfig->folder_slug, "abertura")==0) {
            $user = Auth::user();
            $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',0)->get();
            $data['registos']=$registos;
        }
        if (strcmp($pageConfig->folder_slug, "fecho")==0) {
            $user = Auth::user();
            $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',1)->get();
            $data['registos']=$registos;
        }

        // Outras configurações e variáveis relevantes
        return $data;
    }

}
