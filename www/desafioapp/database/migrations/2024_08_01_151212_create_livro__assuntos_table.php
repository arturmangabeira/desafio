<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAssuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('Livro_Codl');
            $table->foreign('Livro_Codl')->references('Codl')->on('Livro');
            $table->unsignedBigInteger('Assunto_CodAs');
            $table->foreign('Assunto_CodAs')->references('CodAs')->on('Assunto');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Livro_Assunto');
    }
}
