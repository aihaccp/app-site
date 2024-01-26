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
        Schema::create('plano_controlo_analise', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();

            $table->bigInteger('id_plano_analise')->nullable()->unsigned();

            $table->bigInteger('id_controlo_analise')->nullable()->unsigned();

            $table->bigInteger('id_frequencia')->nullable()->unsigned();

            $table->bigInteger('id_amostragem')->nullable()->unsigned();

            $table->integer('n_resultados_amostragem')->nullable();
            $table->text('criterio_avaliacao')->nullable();
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
        Schema::dropIfExists('plano_controlo_analise');
    }
};
