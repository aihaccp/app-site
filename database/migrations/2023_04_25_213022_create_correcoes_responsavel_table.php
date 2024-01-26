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
        Schema::create('correcoes_responsavel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigInteger('id_correcoes_ppr')->unsigned();

            $table->bigInteger('id_responsavel')->unsigned();

            $table->bigInteger('id_ppr')->unsigned();

            $table->bigInteger('id_passos_ppr')->unsigned();

            $table->primary(['id_correcoes_ppr','id_responsavel','id_ppr','id_passos_ppr']);
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
        Schema::dropIfExists('correcoes_responsavel');
    }
};
