<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioPersonaContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('socio_persona_contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('persona_contacto_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('fecha_creacion')->nullable();
            $table->unsignedBigInteger('user_creacion')->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->unsignedBigInteger('user_modificacion')->nullable();
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
        Schema::dropIfExists('socio_persona_contactos');
    }
}
