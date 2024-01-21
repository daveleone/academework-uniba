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
        Schema::create('closed_ex_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('position');
            $table->longText('content');
            $table->boolean('truth');
            $table->unsignedBigInteger('exerciseId');
            $table->foreign('exerciseId')->references('id')->on('exercises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closed_ex_elements');
    }
};