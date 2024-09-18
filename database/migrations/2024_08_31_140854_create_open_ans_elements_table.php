<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('open_ans_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('given_answers')->onDelete('cascade');
            $table->foreignId('ex_elem_id')->constrained('open_ex_elements')->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('open_ans_elements');
    }
};
