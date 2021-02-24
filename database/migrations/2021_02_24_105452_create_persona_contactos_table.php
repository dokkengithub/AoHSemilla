<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('persona_contactos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('titulo')->nullable();
            $table->string('primer_nombre', 200)->nullable();
            $table->string('segundo_nombre', 200)->nullable();
            $table->string('apellido_paterno', 200)->nullable();
            $table->string('apellido_materno', 200)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('telefono_1', 200)->nullable();
            $table->string('telefono_2', 200)->nullable();
            $table->string('movil', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->unsignedBigInteger('ciudad_nacimiento')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_contactos');
    }
}
