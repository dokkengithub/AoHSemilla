<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunidadEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('oportunidad_etapas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oportunidad_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_cierre')->nullable();
            $table->unsignedBigInteger('empleado_ventas')->nullable();
            $table->unsignedBigInteger('etapa')->nullable();
            $table->decimal('porcentaje', 10, 2)->default('0');
            $table->decimal('monto_potencial', 18, 2)->default('0');
            $table->decimal('importe_ponderado', 18, 2)->default('0');
            $table->unsignedBigInteger('clase_documento')->nullable();
            $table->unsignedBigInteger('nro_documento')->nullable();
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
        Schema::dropIfExists('oportunidad_etapas');
    }
}
