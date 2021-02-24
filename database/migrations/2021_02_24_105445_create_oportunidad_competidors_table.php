<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunidadCompetidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('oportunidad_competidors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oportunidad_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('competidor')->nullable();
            $table->unsignedBigInteger('nivelamenaza_id')->nullable();
            $table->longText('comentario')->nullable();
            $table->boolean('ganado')->default(false);
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
        Schema::dropIfExists('oportunidad_competidors');
    }
}
