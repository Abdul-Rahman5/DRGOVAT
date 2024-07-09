<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->string('heart_rate',255);
            $table->string('blood_pressure',255);
            $table->string('respiratory_rate',255);
            $table->integer('oxygen_saturation');
            $table->integer('end_tidal_carbon');
            $table->decimal('temperature', 4, 1); 
            $table->integer('electrocardiogram');
            //----relation
            $table->foreignId('patient_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
