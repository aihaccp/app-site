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
        Schema::create('frequencia_verificacao_monitorizacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigInteger('id_verificacao')->unsigned();

            $table->bigInteger('id_frequencia')->unsigned();

            $table->bigInteger('id_ppr')->unsigned();

            $table->bigInteger('id_passo')->unsigned();

            $table->primary(['id_verificacao','id_frequencia','id_ppr','id_passo']);

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
        Schema::dropIfExists('frequencia_verificacao_monitorizacao');
    }
};
