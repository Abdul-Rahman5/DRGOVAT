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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string("name",255)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();  // gender as enum
            $table->integer('age')->nullable();
            $table->decimal('weight', 8, 2);  // weight in decimal format
            $table->string('operations')->nullable(); // operations as string
            $table->decimal('height', 8, 2);
            $table->enum('heart_state', ['stable', 'unstable']);  // heart state as an enum
            $table->boolean('hypertension');  // hypertension as boolean
            $table->boolean('diabetes');  // diabetes as boolean
            $table->enum('full_half', ['full', 'half']);  // full/half as enum
            $table->time('period_of_operation'); // duration as time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
