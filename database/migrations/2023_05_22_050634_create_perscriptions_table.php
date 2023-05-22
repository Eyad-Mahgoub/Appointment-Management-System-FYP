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
        Schema::create('perscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointment', 'id')->cascadeOnDelete();
            $table->foreignId('medicine_id')->constrained('medicines', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('perscriptions');
    }
};
