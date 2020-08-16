<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('reason'); //
            $table->string('diagnosis'); //
            $table->string('observations'); //
            $table->string('blood_pressure'); //
            $table->string('heart_rate'); //
            $table->string('breathing_frequency'); //
            $table->string('weight'); //
            $table->string('height'); //
            $table->string('imc'); //
            $table->string('abdominal_perimeter'); //
            $table->string('capillary_glucose'); //
            $table->string('temperature'); //
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
        Schema::dropIfExists('medical_consultations');
    }
}
