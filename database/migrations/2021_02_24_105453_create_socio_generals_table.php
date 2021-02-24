<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('socio_generals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_header_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('alias', 200)->nullable();
            $table->string('telefono_1', 200)->nullable();
            $table->string('telefono_2', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('sitio_web', 200)->nullable();
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
        Schema::dropIfExists('socio_generals');
    }
}
