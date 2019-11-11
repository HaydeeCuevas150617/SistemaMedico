<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('accidentado', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id')->length(20); 
            $table->String('area_accidente')->length(11);
            $table->String('region_afectada')->length(20);
            $table->String('tipo_lesion')->length(30);
            $table->String('causa_lesion')->length(30);
            $table->String('lugar_accidente')->length(15);
            $table->Text('observaciones_accidente')->length(15);
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
        Schema::dropIfExists('accidentado');
    }
}
