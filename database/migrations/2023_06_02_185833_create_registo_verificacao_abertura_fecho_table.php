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
        Schema::create('registo_verificacao_abertura_fecho', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_registo_aber_fec')->unsigned();

            $table->bigInteger('id_verif_aber_fec')->unsigned();

            $table->integer('verificado');
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
        Schema::dropIfExists('registo_verificacao_abertura_fecho');
    }
};
