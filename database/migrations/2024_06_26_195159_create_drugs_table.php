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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string("name",255);
            $table->text("desc");
            $table->string("image")->nullable();
            $table->integer("loading")->nullable();
            $table->integer("maintenance")->nullable();
            $table->integer("duration")->nullable();
            $table->integer("full_amount")->nullable();
            //----relation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
