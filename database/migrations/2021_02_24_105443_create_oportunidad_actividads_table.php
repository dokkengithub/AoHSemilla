<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunidadActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('oportunidad_actividads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oportunidad_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('fecha_inicio')->nullable();
            $table->time('hora_inicio', 7)->nullable();
            $table->date('fecha_fin')->nullable();
            $table->time('hora_fin', 7)->nullable();
            $table->unsignedBigInteger('asignado_a')->nullable();
            $table->unsignedBigInteger('asignado_por')->nullable();
            $table->longText('comentario')->nullable();
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
        Schema::dropIfExists('oportunidad_actividads');
    }
}
