<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamiento', function (Blueprint $table) {
            $table->unsignedBigInteger('medicamento_id')->length(20);//FORÁNEA
            $table->unsignedBigInteger('paciente_id')->length(20);//FORÁNEA
            $table->Integer('cantidad_medicamento')->length(11);
            //Declaración de varibles como llaves foráneas
            $table->foreign('medicamento_id')->references('id_medicamento')->on('medicamentos');
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');
            $table->timestamps();//crear variables de creación y actualización (created_at y update_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamiento');
    }
}
