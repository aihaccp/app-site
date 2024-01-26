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
        Schema::create('item_acao_frequencia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();

            $table->bigInteger('id_item')->nullable()->unsigned();

            $table->bigInteger('id_tipo_acao')->nullable()->unsigned();

            $table->bigInteger('id_frequencia')->nullable()->unsigned();

            $table->bigInteger('id_plano_higienizacao')->nullable()->unsigned();

            $table->bigInteger('id_produto_quimico')->nullable()->unsigned();
            
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
        Schema::dropIfExists('item_acao_frequencia');
    }
};
