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
        Schema::create('pharmacy_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments', 'id')->cascadeOnDelete();
            $table->foreignId('pharmacist_id')->constrained('pharmacists', 'id')->cascadeOnDelete();
            $table->integer('total_price');
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
        Schema::dropIfExists('pharmacy_invoices');
    }
};
