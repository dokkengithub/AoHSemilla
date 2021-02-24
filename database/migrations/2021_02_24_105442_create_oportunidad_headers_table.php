<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunidadHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunidad_headers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_oportunidad', 200)->nullable();
            $table->unsignedBigInteger('estado_documento')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_cierre')->nullable();
            $table->decimal('porcentaje_cierre', 10, 2)->default('0');
            $table->unsignedBigInteger('tipo_oportunidad')->nullable();
            $table->unsignedBigInteger('codigo_socio')->nullable();
            $table->unsignedBigInteger('codigo_persona_contacto')->nullable();
            $table->unsignedBigInteger('territorio_socio_negocio')->nullable();
            $table->unsignedBigInteger('codigo_empleado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oportunidad_headers');
    }
}
