<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Se realiza un nuevo esquema con el comando CREATE SCHEMA el cual
        permite crear un nuevo esquema SQL con el nombre que se encuentre 
        en la base de datos.
        Después se especifican las columnas que tendrá en la base de datos,
        dentro de la variable $table */
        Schema::create('pacientes', function (Blueprint $table) {
            //Nombres de las columnas que va a contener la tabla,también contiene la longitud.
            $table->bigIncrements('id_paciente')->length(20)->onDelete('cascade'); /*Está es la llave primaria de la tabla Pacientes,tipo bigIncrements*/
            $table->String('matricula')->length(10);
            $table->String('nombre')->length(50);
            $table->Date('fecha_nac')->length(10);// Fecha de nacimiento que va a generar la edad posteriormente.
            $table->unsignedBigInteger('area_id')->length(20); //FORÁNEA de tipo unignedBigInteger [1]
            $table->String('diagnostico')->length(50);
            $table->String('envio_imss')->length(2);
            $table->Text('razon_ref')->nullable();// ->nullable() indica que puede ser nula
            $table->unsignedBigInteger('afeccion_id')->length(20);//FORÁNEA[2]
            $table->unsignedBigInteger('user_id')->length(20);//FORÁNEA [3]
            $table->timestamps(); //Añade los timestamps "created_at" y "updated_at"
            //Relación con las llaves foráneas
            /*[1]*/$table->foreign('area_id')->references('id_carrera')->on('carrera');
            /*[2]*/$table->foreign('afeccion_id')->references('id_afeccion')->on('afeccion');
            /*[3]*/$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
