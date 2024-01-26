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
        Schema::create('plano_ppro_haccp', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->char('fase_processo',45)->nullable();
            $table->integer('numero')->nullable();
            $table->text('perigo')->nullable();
            $table->text('limite_critico')->nullable();
            $table->text('medidas_controlo')->nullable();

            $table->bigInteger('id_empresa')->nullable()->unsigned();

            $table->bigInteger('id_verificao')->nullable()->unsigned();

            $table->bigInteger('id_correcoes')->nullable()->unsigned();

            $table->bigInteger('id_monitorizacao')->nullable()->unsigned();

            $table->bigInteger('id_tipo')->nullable()->unsigned();
            
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
        Schema::dropIfExists('plano_ppro_haccp');
    }
};
