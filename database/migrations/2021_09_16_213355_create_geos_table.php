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
            $table->string('codMovistar')->nullable();
            $table->string('codClaro')->nullable();
            $table->string('codCnt')->nullable();
            $table->string('potenciaMovistar')->nullable();
            $table->string('potenciaClaro')->nullable();
            $table->string('potemciaCnt')->nullable();
            $table->string('tiempoActualizacion')->nullable();
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
