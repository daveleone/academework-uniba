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
        Schema::create('fill_ex_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('position');
            $table->longText('content');
            $table->text('type'); // text/input
            $table->unsignedBigInteger('exercise_id');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_ex_elements');
    }
};
