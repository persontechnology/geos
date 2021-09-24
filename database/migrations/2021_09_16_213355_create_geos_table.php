<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codDispositivo')->nullable();
            $table->string('codMovi')->nullable();
            $table->string('celdaMovi')->nullable();
            $table->string('codClaro')->nullable();
            $table->string('celdaClaro')->nullable();
            $table->string('codCnt')->nullable();
            $table->string('celdaCnt')->nullable();
            $table->string('potenciaMovistar')->nullable();
            $table->string('potenciaClaro')->nullable();
            $table->string('potenciaCnt')->nullable();
            $table->string('tiempoActualizacion')->nullable();
            $table->string('auxlt')->nullable();
            $table->string('auxln')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geos');
    }
}
