<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbarazadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embarazada', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id')->length(20); 
            $table->String('control')->length(20);
            $table->Text('comentarios');
            $table->Date('f_prob_parto');
            $table->Date('f_ingreso');
            $table->Integer('semanas_embarazo')->length(2);
            $table->timestamps();//crear variables de creación y actualización (created_at y update_at)
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embarazada');
    }
}
