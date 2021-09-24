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
            $table->string('codi')->nullable()->default('');
            $table->string('radio')	->nullable()->default('');
            $table->string('mcc')	->nullable()->default('');
            $table->string('net')	->nullable()->default('');
            $table->string('area')	->nullable()->default('');
            $table->string('cell')	->nullable()->default('');
            $table->string('lon')	->nullable()->default('');
            $table->string('lat')	->nullable()->default('');
            $table->string('range')	->nullable()->default('');
            $table->string('potencia')->nullable()->default('');

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
