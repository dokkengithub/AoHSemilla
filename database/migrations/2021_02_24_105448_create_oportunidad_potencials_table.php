<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunidadPotencialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('oportunidad_potencials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oportunidad_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('cierre_planificado_en')->nullable();
            $table->unsignedBigInteger('cierre_planificado_tipo')->nullable();
            $table->date('fecha_cierre_prevista')->nullable();
            $table->decimal('monto_potencial', 18, 2)->default('0');
            $table->decimal('monto_ponderado', 18, 2)->default('0');
            $table->decimal('porc_ganancia_bruta', 10, 2)->default('0');
            $table->decimal('ganancia_bruta_total', 10, 2)->default('0');
            $table->decimal('nivel_de_interes', 18, 4)->default('0');
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
        Schema::dropIfExists('oportunidad_potencials');
    }
}
