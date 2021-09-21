<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antenas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Tec')->nullable();
            $table->string('Cod') ->nullable();
            $table->string('Long') ->nullable();
            $table->string('Lat') ->nullable();
            $table->string('P') ->nullable();
            $table->string('CodHexa') ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antenas');
    }
}
