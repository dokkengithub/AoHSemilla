<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('socio_headers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200)->nullable();
            $table->unsignedBigInteger('tipo_de_socio')->nullable();
            $table->unsignedBigInteger('codigo_grupo')->nullable();
            $table->unsignedBigInteger('codigo_moneda')->nullable();
            $table->char('ruc', 10)->nullable();
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
        Schema::dropIfExists('socio_headers');
    }
}
