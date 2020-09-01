<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_clinics', function (Blueprint $table) {
            $table->id();
            $table->string('personal_history'); //  Antecedentes Personales
            $table->string('family_background'); // Antecedentes Familiares
            $table->string('current_illness'); // Enfermedad Actual
            $table->string('habits'); //Habitos
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_clinics');
    }
}
