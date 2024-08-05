<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Livro_Autor', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('Livro_Codl');
            $table->foreign('Livro_Codl')->references('Codl')->on('Livro');            
            $table->unsignedBigInteger('Autor_CodAu');
            $table->foreign('Autor_CodAu')->references('CodAu')->on('Autor');
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
        Schema::dropIfExists('Livro_Autor');
    }
}
