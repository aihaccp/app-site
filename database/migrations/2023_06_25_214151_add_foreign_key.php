<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analise_registo', function(Blueprint $table){
            $table->foreign('id_plano_analise')->references('id')->on('plano_analise');
            $table->foreign('id_registo')->references('id')->on('registo');
        });

        Schema::table('area', function(Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('passos_ppr', function (Blueprint $table){
            $table->foreign('id_ppr')->references('id')->on('plano_procedimento_registo');
            $table->foreign('id_passo')->references('id')->on('passo');
        });

        Schema::table('correcoes_responsavel', function(Blueprint $table){
            $table->foreign('id_correcoes_ppr')->references('id')->on('correcoes');
            $table->foreign('id_responsavel')->references('id')->on('responsavel');
            $table->foreign('id_ppr')->references('id_ppr')->on('passos_ppr');
            $table->foreign('id_passos_ppr')->references('id_passo')->on('passos_ppr');
        });

        Schema::table('departamento', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('equipamento', function (Blueprint $table){
            $table->foreign('id_area')->references('id')->on('area');
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('folders', function (Blueprint $table){
            $table->foreign('id_company')->references('id')->on('companies');
            $table->foreign('dad')->references('id')->on('folders');
        });

        Schema::table('folders_modules', function(Blueprint $table){
            $table->foreign('id_folders')->references('id')->on('folders');
            $table->foreign('id_modules')->references('id')->on('modules');
        });

        Schema::table('formacao', function(Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_tipo_acao')->references('id')->on('tipo_acao_formacao');
            $table->foreign('id_entidade_formadora')->references('id')->on('entidade_formadora');
        });

        Schema::table('formacao_departamento', function(Blueprint $table){
            $table->foreign('id_formacao')->references('id')->on('formacao');
            $table->foreign('id_departamento')->references('id')->on('departamento');
        });

        Schema::table('frequencia_monitorizacao', function(Blueprint $table){
            $table->foreign('id_frequencia')->references('id')->on('frequencia');
            $table->foreign('id_monitorizacao')->references('id')->on('monitorizacao');
        });

        Schema::table('frequencia_verificacao_monitorizacao', function(Blueprint $table){
            $table->foreign('id_verificacao')->references('id')->on('verificacao_monitorizacao');
            $table->foreign('id_frequencia')->references('id')->on('frequencia');
            $table->foreign('id_ppr')->references('id')->on('plano_procedimento_registo');
            $table->foreign('id_passo')->references('id')->on('passo');
        });

        Schema::table('item_acao_frequencia', function (Blueprint $table){
            $table->foreign('id_item')->references('id')->on('item_higienizar');
            $table->foreign('id_tipo_acao')->references('id')->on('tipo_acao');
            $table->foreign('id_frequencia')->references('id')->on('frequencia');
            $table->foreign('id_plano_higienizacao')->references('id')->on('plano_higienizacao');
            $table->foreign('id_produto_quimico')->references('id')->on('produto_quimico');
        });

        Schema::table('modules_companies', function (Blueprint $table){
            $table->foreign('id_modules')->references('id')->on('modules');
            $table->foreign('id_companies')->references('id')->on('companies');
        });

        Schema::table('monitorizacao_responsavel', function (Blueprint $table){
            $table->foreign('id_responsavel')->references('id')->on('responsavel');
            $table->foreign('id_monitorizacao')->references('id')->on('monitorizacao');
        });

        Schema::table('passo', function (Blueprint $table){
            $table->foreign('id_tipo_passo')->references('id')->on('tipo_passo');
        });

        Schema::table('permission_role', function (Blueprint $table){
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('plano_analise', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('plano_controlo_analise', function (Blueprint $table){
            $table->foreign('id_plano_analise')->references('id')->on('plano_analise');
            $table->foreign('id_controlo_analise')->references('id')->on('controlo_analise');
            $table->foreign('id_frequencia')->references('id')->on('frequencia');
            $table->foreign('id_amostragem')->references('id')->on('amostragem');
        });

        Schema::table('plano_higienizacao', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_area')->references('id')->on('area');
        });

        Schema::table('plano_ppro_haccp', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_verificao')->references('id')->on('verificacao_monitorizacao');
            $table->foreign('id_correcoes')->references('id')->on('correcoes');
            $table->foreign('id_monitorizacao')->references('id')->on('monitorizacao');
            $table->foreign('id_tipo')->references('id')->on('tipo_tabela');
        });

        Schema::table('plano_procedimento_registo', function (Blueprint $table) {
            $table->foreign('id_verificacao')->references('id')->on('verificacao_monitorizacao');
            $table->foreign('id_correcoes')->references('id')->on('correcoes');
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('registo_correcoes', function (Blueprint $table){
            $table->foreign('id_correcoes')->references('id')->on('correcoes');
            $table->foreign('id_registo_ppr')->references('id')->on('registo');
        });

        Schema::table('registo_higienizacao', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_area')->references('id')->on('area');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_acao_frequencia')->references('id')->on('item_acao_frequencia');
        });

        Schema::table('registo_temperatura', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_equipamento')->references('id')->on('equipamento');
        });

        Schema::table('roles_modules', function (Blueprint $table){
            $table->foreign('id_roles')->references('id')->on('roles');
            $table->foreign('id_modules')->references('id')->on('modules');
        });

        Schema::table('users_roles', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('verificacao_monitorizacao', function (Blueprint $table){
            $table->foreign('id_tipo')->references('id')->on('tipo_tabela');
        });

        Schema::table('verificacao_monitorizacao_responsavel', function (Blueprint $table){
            $table->foreign('id_verificacao')->references('id')->on('verificacao_monitorizacao');
            $table->foreign('id_responsavel')->references('id')->on('responsavel');
            $table->foreign('id_ppr')->references('id')->on('plano_procedimento_registo');
            $table->foreign('id_passo')->references('id')->on('passo');
        });

        Schema::table('users', function (Blueprint $table){
            $table->foreign('id_company')->references('id')->on('companies');
        });

        Schema::table('processo_monitorizacao_higienizacao', function (Blueprint $table){
            $table->foreign('id_procedimento')->references('id')->on('procedimento');
            $table->foreign('id_responsavel')->references('id')->on('responsavel');
        });

        Schema::table('produto_quimico', function(Blueprint $table) {
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('abertura_fecho', function (Blueprint $table) {
            $table->foreign('id_empresa')->references('id')->on('companies');
        });

        Schema::table('verificacao_abertura_fecho', function (Blueprint $table){
            $table->foreign('id_abertura_fecho')->references('id')->on('abertura_fecho');
        });

        Schema::table('registo_abertura_fecho', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
            $table->foreign('id_abertura_fecho')->references('id')->on('abertura_fecho');
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('registo_verificacao_abertura_fecho', function (Blueprint $table){
            $table->foreign('id_registo_aber_fec')->references('id')->on('registo_abertura_fecho');
            $table->foreign('id_verif_aber_fec')->references('id')->on('verificacao_abertura_fecho');
        });

        Schema::table('alerta', function (Blueprint $table){
            $table->foreign('id_empresa')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analise_registo', function(Blueprint $table)
        {
            $table->dropForeign('id_plano_analise');
            $table->dropForeign('id_registo');
        });

        Schema::table('area', function(Blueprint $table){
            $table->dropForeign('id_empresa');
        });

        Schema::table('passos_ppr', function (Blueprint $table){
            $table->dropForeign('id_ppr');
            $table->dropForeign('id_passo');
        });

        Schema::table('correcoes_responsavel', function(Blueprint $table){
            $table->dropForeign('id_correcoes_ppr');
            $table->dropForeign('id_responsavel');
            $table->dropForeign('id_ppr');
            $table->dropForeign('id_passos_ppr');
        });

        Schema::table('departamento', function (Blueprint $table){
            $table->dropForeign('id_empresa');
        });

        Schema::table('equipamento', function (Blueprint $table){
            $table->dropForeign('id_area');
            $table->dropForeign('id_empresa');
        });

        Schema::table('folders', function (Blueprint $table){
            $table->dropForeign('id_company');
            $table->dropForeign('dad');
        });

        Schema::table('folders_modules', function(Blueprint $table){
            $table->dropForeign('id_folders');
            $table->dropForeign('id_modules');
        });

        Schema::table('formacao', function(Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_tipo_acao');
            $table->dropForeign('id_entidade_formadora');
        });

        Schema::table('formacao_departamento', function(Blueprint $table){
            $table->dropForeign('id_formacao');
            $table->dropForeign('id_departamento');
        });

        Schema::table('frequencia_monitorizacao', function(Blueprint $table){
            $table->dropForeign('id_frequencia');
            $table->dropForeign('id_monitorizacao');
        });

        Schema::table('frequencia_verificacao_monitorizacao', function(Blueprint $table){
            $table->dropForeign('id_verificacao');
            $table->dropForeign('id_frequencia');
            $table->dropForeign('id_ppr');
            $table->dropForeign('id_passo');
        });

        Schema::table('item_acao_frequencia', function (Blueprint $table){
            $table->dropForeign('id_item');
            $table->dropForeign('id_tipo_acao');
            $table->dropForeign('id_frequencia');
            $table->dropForeign('id_plano_higienizacao');
            $table->dropForeign('id_produto_quimico');
        });

        Schema::table('modules_companies', function (Blueprint $table){
            $table->dropForeign('id_modules');
            $table->dropForeign('id_companies');
        });

        Schema::table('monitorizacao_responsavel', function (Blueprint $table){
            $table->dropForeign('id_responsavel');
            $table->dropForeign('id_monitorizacao');
        });

        Schema::table('passo', function (Blueprint $table){
            $table->dropForeign('id_tipo_passo');
        });

        Schema::table('permission_role', function (Blueprint $table){
            $table->dropForeign('permission_id');
            $table->dropForeign('role_id');
        });

        Schema::table('plano_analise', function (Blueprint $table){
            $table->dropForeign('id_empresa');
        });

        Schema::table('plano_controlo_analise', function (Blueprint $table){
            $table->dropForeign('id_plano_analise');
            $table->dropForeign('id_controlo_analise');
            $table->dropForeign('id_frequencia');
            $table->dropForeign('id_amostragem');
        });

        Schema::table('plano_higienizacao', function (Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_area');
        });

        Schema::table('plano_ppro_haccp', function (Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_verificao');
            $table->dropForeign('id_correcoes');
            $table->dropForeign('id_monitorizacao');
            $table->dropForeign('id_tipo');
        });

        Schema::Table('plano_procedimento_registo', function (Blueprint $table) {
            $table->dropForeign('id_verificacao');
            $table->dropForeign('id_correcoes');
            $table->dropForeign('id_empresa');
        });

        Schema::table('registo_correcoes', function (Blueprint $table){
            $table->dropForeign('id_correcoes');
            $table->dropForeign('id_registo_ppr');
        });

        Schema::table('registo_higienizacao', function (Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_area');
            $table->dropForeign('id_user');
            $table->dropForeign('id_acao_frequencia');
        });

        Schema::table('registo_temperatura', function (Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_user');
            $table->dropForeign('id_equipamento');
        });

        Schema::table('roles_modules', function (Blueprint $table){
            $table->dropForeign('id_roles');
            $table->dropForeign('id_modules');
        });

        Schema::table('users_roles', function (Blueprint $table){
            $table->dropForeign('user_id');
            $table->dropForeign('role_id');
        });

        Schema::table('verificacao_monitorizacao', function (Blueprint $table){
            $table->dropForeign('id_tipo');
        });

        Schema::table('verificacao_monitorizacao_responsavel', function (Blueprint $table){
            $table->dropForeign('id_verificacao');
            $table->dropForeign('id_responsavel');
            $table->dropForeign('id_ppr');
            $table->dropForeign('id_passo');
        });

        Schema::table('users', function (Blueprint $table){
            $table->dropForeign('id_company');
        });

        Schema::table('processo_monitorizacao_higienizacao', function (Blueprint $table){
            $table->dropForeign('id_procedimento');
            $table->dropForeign('id_responsavel');
        });

        Schema::table('produto_quimico', function(Blueprint $table) {
            $table->dropForeign('id_empresa');
        });

        Schema::table('abertura_fecho', function (Blueprint $table) {
            $table->dropForeign('id_empresa');
        });

        Schema::table('verificacao_abertura_fecho', function (Blueprint $table){
            $table->dropForeign('id_abertura_fecho');
        });

        Schema::table('registo_abertura_fecho', function (Blueprint $table){
            $table->dropForeign('id_empresa');
            $table->dropForeign('id_abertura_fecho');
            $table->dropForeign('id_user');
        });

        Schema::table('registo_verificacao_abertura_fecho', function (Blueprint $table){
            $table->dropForeign('id_registo_aber_fec');
            $table->dropForeign('id_verif_aber_fec');
        });

        Schema::table('alerta', function (Blueprint $table){
            $table->dropForeign('id_empresa');
        });
    }
};
