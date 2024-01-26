<?php

namespace App\Http\Controllers;

use App\Models\AberturaFecho;
use App\Models\Company;
use App\Models\Equipamento;
use App\Models\ItemAcaoFrequencia;
use App\Models\Module;
use App\Models\PageConfig;
use App\Models\RegistoAberturaFecho;
use App\Models\RegistoAcoesCorretivas;
use App\Models\RegistoDemonstracaoProcedimento;
use App\Models\RegistoHigienizacao;
use App\Models\RegistoTemperatura;
use App\Models\VerificacaoAberturaFecho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistoController extends Controller
{
    //
    public function show($moduleSlug, $folderSlug)
    {
        $pageConfig = $this->getPageConfig($moduleSlug, $folderSlug);
        if ($pageConfig) {
            $user = Auth::user();
            $uuid = session('uuid');
            $id_company = Company::where('uuid', $uuid)->first()->id;
            if(strcmp($pageConfig->folder_slug, "abertura")==0){
                $data = $this->prepareData($pageConfig);
                $modulePath = 'modules.' . $moduleSlug . '.folders.'. $folderSlug . '.add';
                $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',0)->get();
                $abertura = AberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',0)->first();
                if($abertura){
                    $verificacoes = VerificacaoAberturaFecho::where('id_abertura_fecho', $abertura->id)->get();
                    return view($modulePath , ['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $registos, 'verificacoes' => $verificacoes, 'tipo' => 0]);
                }
                return view('modules.' . $moduleSlug . '.folders.'. $folderSlug . '.show')->with(['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $registos]);


            }else if (strcmp($pageConfig->folder_slug, "fecho")==0) {
                $data = $this->prepareData($pageConfig);
                $modulePath = 'modules.' . $moduleSlug . '.folders.'. $folderSlug . '.add';
                $registos = RegistoAberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',1)->get();
                $fecho = AberturaFecho::where('id_empresa', $id_company)->where('tipo_abertura_fecho',1)->first();
                if($fecho){
                    $verificacoes = VerificacaoAberturaFecho::where('id_abertura_fecho', $fecho->id)->get();
                    return view($modulePath , ['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $registos, 'verificacoes' => $verificacoes, 'tipo' => 1]);
                }
                return view('modules.' . $moduleSlug . '.folders.'. $folderSlug . '.show')->with(['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $registos]);

            }else{
                $data = $this->prepareData($pageConfig);
                $modulePath = 'modules.' . $moduleSlug . '.folders.'. $folderSlug . '.add';
                return view($modulePath)->with(['module'=>$data['module'],'folder'=>$folderSlug, 'registos' => $data['registos']]);
            }
        } else {
            abort(404);
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
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        // Exemplo de configuração em que o nome da variável no banco de dados é 'title'
        $data['module'] = $pageConfig->module_slug;
        $data['folder'] = $pageConfig->folder_slug;
        $user = Auth::user();
        if (strcmp($pageConfig->folder_slug, "higienizacao")==0) {
            $registos = RegistoHigienizacao::where('id_empresa', $id_company)->get();
            foreach($registos as $registoAux){
                $item_acao_frequencia = ItemAcaoFrequencia::where('id', $registoAux->id_acao_frequencia)->first();
                $registoAux->id_item = $item_acao_frequencia->id_item;
            }
            $data['registos']=$registos;
        }
        if (strcmp($pageConfig->folder_slug, "temperatura")==0) {
            $uuid = $id_company;
            $id_company= Company::where('uuid', $uuid)->first();
            $registos = RegistoTemperatura::where('id_empresa', $id_company)->get();
            foreach($registos as $registoAux){
                $equipamento = Equipamento::where('id', $registoAux->id_equipamento)->first();
                $registoAux->temp_min = $equipamento->temp_min;
                $registoAux->temp_max = $equipamento->temp_max;
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
