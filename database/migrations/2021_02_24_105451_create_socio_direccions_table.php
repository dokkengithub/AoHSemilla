<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('socio_direccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('direccion_id');
            $table->unsignedBigInteger('tipo_direccion')->nullable();
            $table->string('direccion_completa', 200)->nullable();
            $table->integer('pais')->nullable();
            $table->integer('departamento')->nullable();
            $table->integer('provincia')->nullable();
            $table->integer('distrito')->nullable();
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
        Schema::dropIfExists('socio_direccions');
    }
}
