<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerplantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('powerplants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('PlantID');
            $table->string('SubplantID');
            $table->string('Projektname');
            $table->string('Town');
            $table->string('TotalkWp');
            $table->string('TotalSubplants');
            $table->string('IP');
            $table->string('dyndns');
            $table->string('Inverter');
            $table->string('SubplantkWp');
            $table->string('CASID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('powerplants');
    }
}
