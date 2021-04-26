<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_medicals', function (Blueprint $table) {
          $table->id();
          $table->string('description');

          $table->unsignedBigInteger('specialty_id');

          $table->unsignedBigInteger('doctor_id');

          $table->unsignedBigInteger('patient_id');

          $table->unsignedBigInteger('history_clinic_id');
          $table->foreign('history_clinic_id')->references('id')->on('history_clinics');

          $table->string('cancellation_justification')->nullable();

          $table->unsignedBigInteger('cancelled_by_id')->nullable(); // Columna Renombrada

          $table->date('schedule_date');
          $table->time('schedule_time');

          $table->string('type');

          $table->string('status')->default('Reservada'); //Esta estaba como un añadido

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
        Schema::dropIfExists('appointment_medicals');
    }
}
