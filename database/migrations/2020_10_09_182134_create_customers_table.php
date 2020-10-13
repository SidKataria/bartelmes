<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Customer_ID');
            $table->string('Suplant');
            $table->string('Company_Name')->nullable();
            $table->string('Street')->nullable();
            $table->string('PLZ')->nullable();
            $table->string('Ort')->nullable();
            $table->string('State')->nullable();
            $table->string('Country');
            $table->string('Email1')->nullable();
            $table->string('Email2')->nullable();
            $table->string('Email3')->nullable();
            $table->string('Email4_sonstige')->nullable();
            $table->string('Tel_1')->nullable();
            $table->string('bosten_DEB')->nullable();
            $table->string('sunfactory_DEB')->nullable();
            $table->string('EMA_DEB')->nullable();
            $table->string('KontoIBAN')->nullable();
            $table->string('KontoBIC')->nullable();
            $table->string('CC_Empf')->nullable();
            $table->string('Steuerberater')->nullable();
            $table->string('Gruss1')->nullable();
            $table->string('Gruss2')->nullable();		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
