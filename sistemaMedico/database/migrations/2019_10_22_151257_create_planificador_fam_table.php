<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanificadorFamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificador_fam', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id')->length(20); 
            $table->String('nss')->length(11);
            $table->String('tipo_metodo')->length(20);
            $table->String('correo')->length(30);
            $table->String('estado')->length(15);
            $table->Date('f_aplicacion');
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
        Schema::dropIfExists('planificador_fam');
    }
}
