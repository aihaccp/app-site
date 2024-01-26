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
        Schema::create('formacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();

            $table->bigInteger('id_empresa')->nullable()->unsigned();

            $table->bigInteger('id_tipo_acao')->nullable()->unsigned();

            $table->char('designacao',45)->nullable();
            $table->text('objetivos')->nullable();
            $table->integer('n_formandos')->nullable();
            $table->double('duracao')->nullable();
            $table->char('localizacao',45)->nullable();
            $table->date('data_prevista')->nullable();
            $table->date('data_realizada')->nullable();

            $table->bigInteger('id_entidade_formadora')->nullable()->unsigned();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formacao');
    }
};
