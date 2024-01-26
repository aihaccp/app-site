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
        Schema::create('registo_abertura_fecho', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_empresa')->unsigned();

            $table->bigInteger('id_abertura_fecho')->unsigned();

            $table->bigInteger('id_user')->unsigned();

            $table->integer('tipo_abertura_fecho');
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
        Schema::dropIfExists('registo_abertura_fecho');
    }
};
