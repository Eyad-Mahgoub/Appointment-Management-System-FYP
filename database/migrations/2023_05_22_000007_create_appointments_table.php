<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors', 'id')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients', 'id')->cascadeOnDelete();
            // $table->foreignId('perscription_id')->constrained('perscriptions', 'id');
            $table->foreignId('report_id')->constrained('icureports', 'id')->nullable();
            $table->date('date');
            $table->tinyInteger('slot');
            $table->string('status');
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
        Schema::dropIfExists('appointments');
    }
};
